<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Illuminate\Support\Facades\File;

class CleanupFiles implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $folderPath;
    protected $zipFilePath;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($folderPath)
    {
        $this->folderPath = $folderPath;
    }



    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Delete the directory
        if (File::isDirectory($this->folderPath)) {
            File::deleteDirectory($this->folderPath);
        }
    }
}
