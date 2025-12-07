<?php

namespace App\Http\Controllers;

use App\Mail\AdminOrderPaid;
use App\Mail\OrderPaidMail;
use App\Mail\OrderPaymentFailed;
use App\Models\Order;
use App\Models\OrderItem;
use App\Traits\ConvertToMoney;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class GuestController extends Controller
{
    use ConvertToMoney;

    public function index()
    {
        return Inertia::render('General/Home');
    }

    public function about()
    {
        $appName = config('app.name');
        $isSubDomain = (explode('.', request()->getHost()))[0] === 'moves' ? true : false;
        $faqArr = [
            [
                'question' => "How do I book a home move with $appName?",
                'answer' => "To book a home move with $appName, simply visit our website and fill out the booking form. The form is in three parts: first step, select the items you want to move and submit; second step, fill out your pick up and delivery details and submit; Last step, enter your contact informations and submit.  " . ($isSubDomain ? 'After submitting, you\ll be redirected to checkout, pay and check your email for further confirmation of successful booking.' : ' You\'ll be redirected to WHATSAPP where our team will then reach out to confirm the details and schedule your move.')
            ],
            [
                'question' => "What types of items can $appName move?",
                'answer' => "$appName transports a wide range of items, including furniture, appliances, electronics, personal belongings, and more. Our experienced team is equipped to handle both residential and commercial moves, ensuring the safe and efficient transportation of your goods."
            ],
            [
                'question' => "What payment methods does $appName accept?",
                'answer' => "$appName accepts various payment methods, including credit/debit cards, bank transfers, and cash. We strive to make the payment process convenient for our customers, offering flexibility and transparency every step of the way."
            ],
            [
                'question' => "How does $appName ensure the safety of my belongings during transit?",
                'answer' => "At $appName, we prioritize the safety of your belongings during transit. We use professional packing materials, secure loading techniques, and experienced movers to minimize the risk of damage or loss. Additionally, all goods being moved by $appName are covered by our robust public liability insurance and goods in transit insurance."
            ],
            [
                'question' => "Does $appName offer international moving services?",
                'answer' => "Yes, $appName offers international moving services to various destinations worldwide. Whether you're moving abroad or moving goods overseas for your business, our experienced team can handle the move, customs clearance, and documentation required for international moves."
            ],
            [
                'question' => "How far in advance should I book my move with $appName?",
                'answer' => "We typically work with a five days notice, this allows us to better accommodate your preferred dates and ensure timely move. Nonetheless, we are also happy to accommodate ad-hoc situations, especially during peak seasons or busy periods so feel free to reach out to us with your requirements."
            ],
        ];
        return Inertia::render('General/About', [
            'faqArr' => $faqArr
        ]);
    }

    
    public function quote()
    {
        $partners = [
            [
                'name' => 'Howdens',
                'alias' => 'HD',
                'description' => 'Howdens was established in 1995 to provide trade customers with kitchens, joinery, and hardware products, which are available from local stock at depots across the UK, France, and Belgium.',
                'url' => 'https://www.howdens.com/',
                'imgUrl' => asset('/images/howdens.svg'),
            ],
            [
                'name' => 'Perplex London',
                'alias' => 'PL',
                'description' => 'PERPLEX creates immersive experiences around the world to celebrate electronic music in sophisticated environments.',
                'url' => 'https://www.perplexlondon.com/',
                'imgUrl' => asset('images/perplex.jpg'),
            ],
            [
                'name' => 'Furniture Village',
                'alias' => 'FV',
                'description' => 'It’s why we travel around the world looking for beautiful designs crafted by furniture makers who are just as obsessive about style and quality as we are. And why you’ll find our designs in real brick-and-mortar stores, so you can see what puts our furniture a cut above the rest for yourself. ',
                'url' => 'https://www.furniturevillage.co.uk/',
                'imgUrl' => asset('/images/furniturevillage.jpeg'),
            ],
            [
                'name' => 'Jobyco',
                'alias' => 'JC',
                'description' => 'Since its inception, Jobyco has been at the forefront of door to door shipping as a leader and a force to be reckoned with by offering most comprehensive coverage of most localities in the United Kingdom to any locality in Ghana.',
                'url' => 'https://www.jobycodirect.com/',
                'imgUrl' => asset('/images/jobyco.svg'),
            ],
        ];

        return inertia('General/Quote')->with(['partners' => $partners]);
    }

    public function tracker()
    {        
        return inertia('General/TrackMove');
    }

    public function trackAndRedirect(Request $request){        
        $request->validate([
            'refId' => ['required','string','exists:orders,order_refNo'],
            'type' => 'required|string|in:monitoring,rescheduling'
        ]);

        $isMonitoringType = $request->type==='monitoring';

        // data returned by user input
        $order = Order::where('order_refNo',$request->refId)->first(); 

        // Construct the message
        $monitoringMsg = "Hello, My name is {$order->username}. I'm contacting you about move with order REFNO: {$order->order_refNo}";
        $reschedulingMsg = "Hello, My name is {$order->username}. I want to discuss rescheduling move with order REFNO: {$order->order_refNo}";
        // Encode the message
        $encodedMessage = urlencode($isMonitoringType ? $monitoringMsg : $reschedulingMsg);

        // Construct the WhatsApp URL
        $whatsappUrl = config('app.socials.whatsapp');
        $redirect = "{$whatsappUrl}?text={$encodedMessage}";

        return response()->json(['redirect' => $redirect]);
    }

    public function contact()
    {
        return inertia('General/Contact');
    }

    public function submitContactForm(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:225',
            'subject' => 'required|string|max:225',
            'email' =>'required|email:dns,rfc',
            'phone'=>['required','regex:/^(\+[0-9] ?+|[0-9] ?+){6,14}[0-9]$/'],
            'inquiry'=>'required|string|max:1000',
        ],[
            'phone.regex' => 'The phone number must be a valid phone number',
        ],[
            'email' => 'E-mail',
            'username'=>'Full Name',
            'phone' => 'Phone number',
            'inquiry'=>'Message'
        ]);

        \App\Models\Inquiry::create($validated);

        return response()->json(['message' =>'Your inquiry has been submitted successfully. We will get back to you soon!']);
    }
}
