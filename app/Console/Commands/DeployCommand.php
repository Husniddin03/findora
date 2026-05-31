<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DeployCommand extends Command
{
    protected $signature = 'deploy';

    protected $description = 'Command description';

    public function handle()
    {
        $runGit = function (string $command): string {
            $process = \Symfony\Component\Process\Process::fromShellCommandline($command);
            $process->run();

            if (! $process->isSuccessful()) {
                // Show the error output and stop execution.
                $this->error('Git command failed: ' . $process->getErrorOutput());
                return '';
            }
            return trim($process->getOutput());
        };

        // 1️⃣ Get list of changed files
        $files = $runGit('git status --porcelain');
        if ($files === '') {
            $this->info('Nothing to commit');
            return self::SUCCESS;
        }

        // 2️⃣ Build a nice bullet‑list for the commit message
        $changedFiles = collect(explode("\n", $files))
            ->map(fn($line) => trim(substr($line, 3)))
            ->implode("\n- ");
        $message = "auto deploy\n\nChanged files:\n- {$changedFiles}";

        $runGit('cd /home/husniddin/vscode/kurs-ishi/FindCourse');

        $runGit('git add .');
        $runGit('git commit -m "' . addslashes($message) . '"');
        $runGit('git push');

        $this->info('Successfully pushed');
        return self::SUCCESS;
    }

}
