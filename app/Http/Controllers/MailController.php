<?php

namespace App\Http\Controllers;

require '../vendor/autoload.php';

use Illuminate\Http\Request;
use Aws\Sqs\SqsClient;
use Aws\Exception\AwsException;

class MailController extends Controller
{
    
    public function index(){
        return response()->json(['SUcesso']);
    }

    public function send(Request $request){
        ini_set('memory_limit', '-1');

        $client = new SqsClient([
            //'profile' => 'default',
            'region' => env('AWS_DEFAULT_REGION'),
            'credentials' => [
                'key' => env('AWS_ACCESS_KEY_ID'),
                'secret' => env('AWS_SECRET_ACCESS_KEY'),
            ],
            'version' => '2012-11-05'
        ]);

        $queueURL = env('AWS_QUEUE_URL');
        $maxQueueSize = 10;
        $messageCount = sizeof($request->messages);

        for($i=0; $i < $messageCount; $i++){
            $message = [
                'sendTo' => $request['messages'][$i]['destinatario'],
                'TemplateData' => json_encode($request['messages'][$i]['templateData']),
                'Source' => 'no-reply@centelhotecnologia.com.br',
                'Template' => 'PrimeiroTemplate'
            ];

            $jsonMessage = json_encode($message);
            
            $batchMessages[] = [
                'DelaySeconds' => 0,
                'Id' => $i+1,
                'MessageDeduplicationId' => $i+1,
                'MessageGroupId' => 'Convite',
                'MessageBody' => $jsonMessage,
            ];
            

            if(sizeof($batchMessages) == $maxQueueSize || $i+1 == $messageCount){
                //var_dump($batchMessages);exit;
                try{
                    $result = $client->sendMessageBatch(['Entries' => $batchMessages, 'QueueUrl' => $queueURL]);
                    $batchMessages = [];
                    return response()->json($result);
                }catch(AwsException $e){
                    throw new \Exception($e->getMessage());
                }
            }

        }

        
        return response()->json($client);

    }
}
