<?php
namespace Mrapps\EmailBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Finder;

class ClearFailedSpoolCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('mrapps:email:clear-failures')
            ->setDescription('Clears email failures from the spool');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $transport = $this->getContainer()->get('swiftmailer.transport.real');
        if (!$transport->isStarted()) {
            $transport->start();
        }

        $spoolPath = $this->getContainer()->get("kernel")->getRootDir() . "/spool";
        $finder = Finder::create()->in($spoolPath)->name('*.sending');

        if ($finder->count() == 0) {
            $output->writeln("<info>Emails failed not found</info>");
        }

        foreach ($finder as $failedFile) {
            // rename the file, so no other process tries to find it
            $tmpFilename = $failedFile . '.finalretry';
            rename($failedFile, $tmpFilename);

            /** @var $message \Swift_Message */
            $message = unserialize(file_get_contents($tmpFilename));
            $output->writeln(sprintf(
                'Retrying <info>%s</info> to <info>%s</info>',
                $message->getSubject(),
                implode(', ', array_keys($message->getTo()))
            ));

            try {
                $transport->send($message);
                $output->writeln('Sent!');
            } catch (\Swift_TransportException $e) {
                $output->writeln('<error>Send failed - deleting spooled message</error>');
            }

            // delete the file, either because it sent, or because it failed
            unlink($tmpFilename);
        }
    }
}