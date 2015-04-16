<?php
class DataTableSeeder extends Seeder {

    public function run()
    {
        DB::table('data_config')->delete();
        Data::create(array('id' => 1, 'key' => 'test_instructions', 'value' => 'Please Complete Test'));
        Data::create(array('id' => 2, 'key' => 'boolean_instructions', 'value' => 'Choose The Most Correct Answer'));
        Data::create(array('id' => 3, 'key' => 'multiple_instructions', 'value' => 'Choose ALL answers that apply.'));
        Data::create(array('id' => 4, 'key' => 'resource_path', 'value' => '/var/www/html/'));
        Data::create(array('id' => 5, 'key' => 'reminder_sent_message', 'value' => 'Reminder Email Was Successfully Sent.<br />Please Follow The Link in your email to reset the Password.'));
        Data::create(array('id' => 6, 'key' => 'reset_password_message', 'value' => 'Your Password Was Successfully Reset.'));
    }
}
