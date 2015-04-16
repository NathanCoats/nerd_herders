<?php
class MessageTableSeeder extends Seeder {

  public function run()
  {
    $message = new Message;
    $message->to_id   = 1;
    $message->from_id = 2;
    $message->title   = "Sweet";
    $message->message = "well Hello";
    $message->is_read = 0;
    $message->is_sent = 1;
    $message->save();
  }
}