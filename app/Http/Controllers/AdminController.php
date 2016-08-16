<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Node;
use App\Calculation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Notification;

use App\User;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function createNotification(Request $request)
    {

        $notification = new Notification;

        $notification->title = $request->subject;

        $notification->content = $request->text;

        $notification->scheduledate = $request->scheduledate;

        $notification->save();

        $notifications = Notification::where("id", ">", 0)->orderBy('id', 'desc')->get();

        return redirect()->route('home', ['notifications' => $notifications,'user' => Auth::user()]);

    }

    public function updateNotification(Request $request)
    {

        $notification = Notification::find($request->id);

        $notification->title = $request->subject;

        $notification->content = $request->text;

        $notification->scheduledate = $request->scheduledate;

        $notification->save();

        $notifications = Notification::where("id", ">", 0)->orderBy('id', 'desc')->get();

        return redirect()->route('home', ['notifications' => $notifications,'user' => Auth::user()]);

    }

    public function deleteNotification(Request $request)
    {

        $notification = Notification::find($request->id);

        $notification->delete();

        $notifications = Notification::where("id", ">", 0)->orderBy('id', 'desc')->get();

        return redirect()->route('home', ['notifications' => $notifications,'user' => Auth::user()]);

    }

    public function createNotificationForm()
    {

        //$notifications = Notification::where("id", ">", 0)->orderBy('id', 'desc')->get();

        return view('createnotification');

    }

    public function updateNotificationForm(Request $request)
    {

        $notification = Notification::find($request->id);

        return view('updatenotification', ["notification" => $notification]);

    }

    public function landingPage()
    {

        //$notifications = Notification::where("id", ">", 0)->orderBy('id', 'desc')->get();

        return Redirect::to("http://www.argentmac.com/delvertassets");

    }

    public function pricingForm()
    {

        //$notifications = Notification::where("id", ">", 0)->orderBy('id', 'desc')->get();

        //$nodes = Node::where("id", ">", 0)->orderBy('id', 'desc')->get();

        $nodes = Node::has('nodes', '=', 0)->get();

        foreach ($nodes as $node) {

            $subtypeString = $node->title;

            $node->subtypeString = $subtypeString;

            //$node->save();

            $nodes2 = Node::where('id', '=', $node->node_id)->get();

            foreach($nodes2 as $node2) {

                $subtypeString = $node2->title . "->" . $subtypeString;

                $node2->subtypeString = $subtypeString;

                //$node2->save();

                $nodes3 = Node::where('id', '=', $node2->node_id)->get();

                foreach($nodes3 as $node3) {

                    $subtypeString = $node3->title . "->" . $subtypeString;

                    $node3->subtypeString = $subtypeString;

                    //$node3->save();

                    $nodes4 = Node::where('id', '=', $node3->node_id)->get();

                    foreach($nodes4 as $node4) {

                        $subtypeString = $node4->title . "->" . $subtypeString;

                        $node4->subtypeString = $subtypeString;

                        //$node4->save();

                        $nodes5 = Node::where('id', '=', $node4->node_id)->get();

                        foreach($nodes5 as $node5) {

                            $subtypeString = $node5->title . "->" . $subtypeString;

                            $node5->subtypeString = $subtypeString;

                            //$node5->save();

                        }

                    }

                }

            }

            $node->subtypeString = $subtypeString;

            $node->subtypeString = $subtypeString;

            $node->save();

        }

        return view('updatepricing', ['nodes' => $nodes]);

    }

    public function updateRegistration(Request $request)
    {

        $user = User::find($request->id);

        $user->fname = $request->fname;

        $user->lname = $request->lname;

        $user->address1 = $request->address1;

        $user->address2 = $request->address2;

        $user->phone = $request->phone;

        $user->email = $request->email;

        $user->zipcode = $request->zipcode;

        $user->country = $request->country;

        $user->save();

        $notifications = Notification::where("id", ">", 0)->orderBy('id', 'desc')->get();

        return redirect()->route('home', ['notifications' => $notifications,'user' => Auth::user()]);

    }

    public function passwordChange(Request $request)
    {

        $user = User::find($request->id);

        if ($request->password == $request->password_confirm) $user->password = Hash::make($request->password);

        $user->save();

        $notifications = Notification::where("id", ">", 0)->orderBy('id', 'desc')->get();

        return redirect()->route('home', ['notifications' => $notifications,'user' => Auth::user()]);

    }

    public function adminUpdateRegistration(Request $request)
    {

        $user = User::find($request->id);

        $user->fname = $request->fname;

        $user->lname = $request->lname;

        $user->address1 = $request->address1;

        $user->address2 = $request->address2;

        $user->phone = $request->phone;

        $user->email = $request->email;

        $user->zipcode = $request->zipcode;

        $user->country = $request->country;

        $user->state = $request->state;

        $user->uses = $request->uses;

        $user->scheduledenddate = $request->scheduledenddate;

        $user->save();

        $notifications = Notification::where("id", ">", 0)->orderBy('id', 'desc')->get();

        return redirect()->route('home', ['notifications' => $notifications,'user' => Auth::user()]);

    }

    public function updatePricing(Request $request)
    {

        $node = Node::find($request->id);

        $node->price_per_meter = $request->price_per_meter;

        $node->blurb = $request->blurb;

        $node->save();

        $nodes = Node::has('nodes', '=', 0)->get();

        foreach ($nodes as $node) {

            $subtypeString = $node->title;

            $nodes2 = Node::where('id', '=', $node->node_id)->get();

            foreach($nodes2 as $node2) {

                $subtypeString = $node2->title . "->" . $subtypeString;

                $node2->subtypeString = $subtypeString;

                $node2->save();

                $nodes3 = Node::where('id', '=', $node2->node_id)->get();

                foreach($nodes3 as $node3) {

                    $subtypeString = $node3->title . "->" . $subtypeString;

                    $node3->subtypeString = $subtypeString;

                    $node3->save();

                    $nodes4 = Node::where('id', '=', $node3->node_id)->get();

                    foreach($nodes4 as $node4) {

                        $subtypeString = $node4->title . "->" . $subtypeString;

                        $node4->subtypeString = $subtypeString;

                        $node4->save();

                        $nodes5 = Node::where('id', '=', $node4->node_id)->get();

                        foreach($nodes5 as $node5) {

                            $subtypeString = $node5->title . "->" . $subtypeString;

                            $node5->subtypeString = $subtypeString;

                            $node5->save();

                        }

                    }

                }

            }

            $node->subtypeString = $subtypeString;

        }

        return view('updatepricing', ['nodes' => $nodes]);

    }

    public function manageUsers (Request $request) {

        $users = User::all();

        return view('manageusers', ['users' => $users]);

    }

    public function manageUser (Request $request) {

        $user = User::find($request->id);

        return view('manageuser', ['user' => $user]);

    }

    public function createCalculation(Request $request)
    {

        $calculation = new Calculation;

        $calculation->area = $request->area;

        $calculation->units = $request->units;

        $calculation->estimate = $request->estimate;

        $calculation->user_id = $request->user_id;

        $node = Node::find($request->node_id);

        $calculation->type = $node->title;

        while ($node->node_id != 0) {

            $node = Node::find($node->node_id);

            $calculation->type = $node->title . "->" . $calculation->type;

        }

        $user = User::find($request->user_id);

        if ($user->state == "Use-Based") $user->uses = $user->uses - 1;

        $user->save();

        $calculation->save();

        //$node = Node::where("id", ">", 0)->orderBy('id', 'desc')->get();

        //return redirect()->route('home', ['notifications' => $notifications,'user' => Auth::user()]);

    }

    public function createNode(Request $request)
    {

        $node = new Node;

        $node->title = $request->title;

        $node->price_per = $request->price_per;

        $node->node_id = $request->parent_id;

        $node->save();

        //$node = Node::where("id", ">", 0)->orderBy('id', 'desc')->get();

        //return redirect()->route('home', ['notifications' => $notifications,'user' => Auth::user()]);

    }

    public function getNodes()
    {

        $jsonString = "[";

        $nodes = Node::where("node_id", "=", 0)->orderBy('id', 'asc')->get();

        foreach ($nodes as $node) {

            $jsonString .= "\r\n{\r\n\"href\":\"javascript:setPrice(" . $node->price_per_meter . ", '" . preg_replace("/[^ \w]+/", "", $node->blurb) . "', " . $node->id .")\",\"subtypeString\": \" . $node->subtypeString .\", \r\n\"text\": \"" . $node->title . "\"";

            $nodes2 = Node::where("node_id", "=", $node->id)->orderBy('id', 'asc')->get();

            if (count($nodes2) > 0) $jsonString .= ",\r\n\"nodes\" : [";

            foreach ($nodes2 as $node2) {

                $jsonString .= "\r\n{\r\n\"href\":\"javascript:setPrice(" . $node2->price_per_meter . ", '" . preg_replace("/[^ \w]+/", "", $node2->blurb) . "', " . $node2->id .")\",\"subtypeString\": \" . $node2->subtypeString .\", \r\n\"text\": \"" . $node2->title . "\"";



                $nodes3 = Node::where("node_id", "=", $node2->id)->orderBy('id', 'asc')->get();

                if (count($nodes3) > 0) $jsonString .= ",\r\n\"nodes\" : [";

                foreach ($nodes3 as $node3) {

                    $jsonString .= "\r\n{\r\n\"href\":\"javascript:setPrice(" . $node3->price_per_meter . ", '" . preg_replace("/[^ \w]+/", "", $node3->blurb) . "', " . $node3->id .")\",\"subtypeString\": \" . $node3->subtypeString .\", \r\n\"text\": \"" . $node3->title . "\"";



                    $nodes4 = Node::where("node_id", "=", $node3->id)->orderBy('id', 'asc')->get();

                    if (count($nodes4) > 0) $jsonString .= ",\r\n\"nodes\" : [";

                    foreach ($nodes4 as $node4) {

                        $jsonString .= "\r\n{\r\n\"href\":\"javascript:setPrice(" . $node4->price_per_meter . ", '" . preg_replace("/[^ \w]+/", "", $node4->blurb) . "', " . $node4->id .")\",\"subtypeString\": \" . $node4->subtypeString .\", \r\n\"text\": \"" . $node4->title . "\"";

                        //$jsonString .= $node2;



                        $nodes5 = Node::where("node_id", "=", $node4->id)->orderBy('id', 'asc')->get();

                        if (count($nodes5) > 0) $jsonString .= ",\r\n\"nodes\" : [";

                        foreach ($nodes5 as $node5) {

                            $jsonString .= "\r\n{\r\n\"href\":\"javascript:setPrice(" . $node5->price_per_meter . ", '" . preg_replace("/[^ \w]+/", "", $node5->blurb) . "', " . $node5->id .")\",\"subtypeString\": \" . $node5->subtypeString .\", \r\n\"text\": \"" . $node5->title . "\"},";

                            //$jsonString .= $node2;

                        }

                        $jsonString = rtrim($jsonString, ",");

                        if (count($nodes5) > 0) $jsonString .= "]";

                        $jsonString .= "},";




                    }

                    $jsonString = rtrim($jsonString, ",");

                    if (count($nodes4) > 0) $jsonString .= "]";

                    $jsonString .= "},";




                }

                $jsonString = rtrim($jsonString, ",");

                if (count($nodes3) > 0) $jsonString .= "]";

                $jsonString .= "},";




            }

            $jsonString = rtrim($jsonString, ",");

            if (count($nodes2) > 0) $jsonString .= "]";

        $jsonString .= "},";

        }

        $jsonString = rtrim($jsonString, ",") .  "]";

        return $jsonString;

    }

}

