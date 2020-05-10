<?php

namespace App\Console\Commands;

use App\Konten;

use Illuminate\Console\Command;

class CronNotifikasi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notifiy:fcm';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Schedule notifikasi fcm ke android';

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
     * @return mixed
     */
    public function handle()
    {
        $konten = Konten::all();
        $rand = rand(0, $konten->count() - 1);
        $url = "https://fcm.googleapis.com/fcm/send";
        $topico = "fp28vk1NQJe4EF0dvbkin7:APA91bF5YuN6I9uSJ3poc1rMixCvQXvyTvxyCnRb2TI8MeeSv1sVDWBbLiy-rHwzsO5D6Ki_7S8G0V_lkXtxKVKGg0mNByi0EivW_NR2ZEYQM-pR4uTgD2xhlOKM6HmFxbsmD89TebzE";
        $api_key = "AAAAUPov5_E:APA91bHeKfnT4_fEenJU1_I8IEiQZIJ6bCeoDqf0qVYVx54UwvZdftRsROJ5iICOOenCFwvbI2LYE_4ID7Vk3wGuWKCRrInMO7Y_3K1d1wfFwBygxNQE9qvqvbhuQ1ysYSS3dYuBz0Iz"; //FIREBASE KEY
        $title = $konten[$rand]['title_notif'];
        $corpo = $konten[$rand]['body_notif'];;
        $legenda = "SubTitle...";


        $headers = array(
            'Authorization: key=' . $api_key,
            'Content-Type: application/json;charset=UTF-8'
        );

        $data = array(
            'notification' =>
            array(
                "body" => $corpo,
                "title" => $title
            ),
            'data' =>
            array(
                "click_action" => "FLUTTER_NOTIFICATION_CLICK",
                "id" => "1",
                "status" => "done",
                "isi_konten" => $konten[$rand]['isi_konten']
            ),
            'registration_ids' => [$topico],
            'priority' => 'high',
            //'restricted_package_name' => 'com.onlyoneapp.test', //IF YOU WANT SEND TO ONLY ONE APP
        );


        $content = json_encode($data);
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($curl);
        curl_close($curl);
        $arr = array();
        $arr = json_decode($result, true);

        echo ($result);
    }
}
