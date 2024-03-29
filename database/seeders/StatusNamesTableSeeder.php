<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusNamesTableSeeder extends Seeder
{
    public function run()
    {
        // Clear the table first to avoid duplicates if you run the seeder multiple times
        DB::table('status_names')->delete();

        // Define your statuses
        $statuses = [
            ['package_status_name' => 'Customer Purchased', 'sort_order' => 1, 'print_export' => false],
            ['package_status_name' => 'Shipped from Store', 'sort_order' => 2, 'print_export' => false],
            ['package_status_name' => 'Received at Freight Forwarder', 'sort_order' => 3, 'print_export' => false],
            ['package_status_name' => 'In transit to Destination Country', 'sort_order' => 4, 'print_export' => false],
            ['package_status_name' => 'Print Receipts for Customs', 'sort_order' => 5, 'print_export' => true], // Mark this status for printing
            ['package_status_name' => 'Receipts Sent', 'sort_order' => 6, 'print_export' => false],
            ['package_status_name' => 'Ready for Pickup', 'sort_order' => 7, 'print_export' => false],
            ['package_status_name' => 'Customer Received', 'sort_order' => 8, 'print_export' => false],
            // Add more statuses as needed
        ];

        // Insert the data into the status_names table
        DB::table('status_names')->insert($statuses);
    }
}
