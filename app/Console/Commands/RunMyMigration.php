<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class RunMyMigration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:icbook-order';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Custom order for magrate files without probleme.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $paths = [
            "database/migrations/2014_10_12_000000_create_users_table.php",
            "database/migrations/2014_10_12_100000_create_password_resets_table.php",
            "database/migrations/2019_08_19_000000_create_failed_jobs_table.php",
            "database/migrations/2019_12_14_000001_create_personal_access_tokens_table.php",

            "database/migrations/2025_03_11_230433_create_messages_table.php",

            "database/migrations/2025_03_11_182713_create_buyers_table.php",
            "database/migrations/2025_03_11_182743_create_sellers_table.php",

            "database/migrations/2025_03_11_182608_create_roles_table.php",
            "database/migrations/2025_03_11_182703_create_permissions_table.php",
            "database/migrations/2025_03_11_182909_create_role_user_table.php",
            "database/migrations/2025_03_11_183055_create_permission_role_table.php",

            "database/migrations/2025_03_11_234029_create_books_table.php",
            "database/migrations/2025_03_11_235615_create_categories_table.php",
            "database/migrations/2025_03_12_112333_create_book_images_table.php",
            "database/migrations/2025_03_12_091041_create_book_category_table.php",

            "database/migrations/2025_03_12_093909_create_physical_books_table.php",
            "database/migrations/2025_03_12_095041_create_electronic_books_table.php",

            "database/migrations/2025_03_11_234829_create_reviews_table.php",
            "database/migrations/2025_03_12_092642_create_orders_table.php",

            "database/migrations/2025_03_12_114003_create_posts_table.php",
            "database/migrations/2025_03_12_114006_create_comments_table.php",
            "database/migrations/2025_03_12_115102_create_likes_table.php"

        ];


        // traitement:
        foreach ($paths as $path) {
            $this->info("Running migration: $path");
            $exitCode = Artisan::call('migrate', ['--path' => $path]);


            if ($exitCode !== 0) {
                $this->error("Migration failed: $path");
                return;
            }
        }


        $this->info('All migrations executed successfully!');
    }
}
