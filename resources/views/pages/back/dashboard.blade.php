@php
    $now = (int)((microtime(true) - LARAVEL_START) * 1000);
    $deg = ((($now / 30) * 2.6) - 130)
@endphp

@extends('pages.back.master')

@section('cssdependancy')
    @parent
    <style>
       .thermometer {
        font-family: sans-serif;
        color: #333;
        position: relative;
        width: 220px;
        height: 220px;
        border-radius: 50%;
        background-color: #EDEDED;
        box-shadow: 2px 4px 8px 0 rgba(0,0,0,0.4);
        }

        .ring {
        position: absolute;
        border-radius: 50%;
        width: 210px;
        height: 210px;
        margin-left: 5px;
        margin-top: 5px;
        background-color: rgba(255,170,0,1);
        background: linear-gradient(to right, rgba(84,255,227,1) 0%, rgba(244,255,84,1) 35%, rgba(255,153,43,1) 69%, rgba(255,38,38,1) 100%);
        box-shadow: inset 2px 4px 4px 0px rgba(0,0,0,0.3);
        }

        .ring .dial-bottom {
            position: relative;
            top: 116px;
            left: 48px;
            width: 117px;
            height: 117px;
            background-color: #EDEDED;
            border-radius: 0 0 0 95%;
            transform: rotate(-45deg);
        }

        .pointer {
        position: absolute;
        top: -38px;
        left: 69px;
        width: 5px;
        height: 37px; 
        background-color: #FFF;
        border: solid 1px #FFF;
        transform-origin: 6px 112px;
        box-shadow: 1px 2px 4px 0 rgba(0,0,0,0.25);
        }
        .pointer.central {
        background-color: black;
        }
        .pointer.basking {
        background-color: #FF3C00;
        border: none;
        width: 2px;
        transform: rotate(-42deg);
        }

        .temperatureContainer {
        width: 150px;
        height: 150px;
        position: relative;
        top: 37px;
        left: 35px;
        background-color: #FFF;
        border-radius: 50%;
        box-shadow: 1px 2px 4px 0 rgba(0,0,0,0.25);
        padding: 1em;
        text-align: center;
        }

        .title {
        font-size: 1em;
        }

        .temperature {
        font-size: 2.5em;
        margin-top: -.2em;
        }
        .central {
        color: #FFAA00;
        }
        .basking {
        color: #FF3C00;
        }

        .degree {
        font-size: 0.6em;
        position: absolute;
        margin-top: .2em;
        }
    </style>
    <script>
        const months = ['Jan','Feb','March','April','May','June','July','Aug','Sep','Oct','Nov','Dec']

        const dynamicColors = () => {
            const r = Math.floor(Math.random() * 200);
            const g = Math.floor(Math.random() * 200);
            const b = Math.floor(Math.random() * 200);
            return "rgb(" + r + "," + g + "," + b + ")";
        }
    </script>
@endsection

@section('body')


<div class="flex flex-wrap">
    <div class="w-full md:w-1/2 xl:w-1/3 p-3">
        <!--Metric Card-->
        <div class="bg-green-100 border-b-4 border-green-600 rounded-lg shadow-lg p-5">
            <div class="flex flex-row items-center">
                <div class="flex-shrink pr-4">
                    <div class="rounded-full p-4 bg-green-600">
                      <svg class="fill-current h-8 svg-icon text-green-100 w-8" viewBox="0 0 20 20">
                        <path fill="" d="M5.109,8.392H4.249c-0.238,0-0.43,0.193-0.43,0.431c0,0.238,0.192,0.431,0.43,0.431h0.861c0.238,0,0.43-0.193,0.43-0.431C5.54,8.585,5.347,8.392,5.109,8.392 M4.249,4.088h11.19c0.238,0,0.431-0.192,0.431-0.43c0-0.238-0.192-0.431-0.431-0.431H4.249c-0.238,0-0.43,0.192-0.43,0.431C3.818,3.896,4.011,4.088,4.249,4.088 M2.527,5.81H17.16c0.238,0,0.431-0.192,0.431-0.43c0-0.238-0.192-0.431-0.431-0.431H2.527c-0.238,0-0.43,0.192-0.43,0.431C2.097,5.617,2.289,5.81,2.527,5.81 M18.452,6.67H1.236c-0.476,0-0.861,0.385-0.861,0.861v8.608c0,0.475,0.385,0.86,0.861,0.86h17.216c0.475,0,0.86-0.386,0.86-0.86V7.531C19.312,7.056,18.927,6.67,18.452,6.67 M1.666,7.531c0.238,0,0.431,0.192,0.431,0.431c0,0.238-0.192,0.43-0.431,0.43c-0.238,0-0.43-0.192-0.43-0.43C1.236,7.724,1.428,7.531,1.666,7.531 M1.666,16.14c-0.238,0-0.43-0.192-0.43-0.431c0-0.237,0.192-0.431,0.43-0.431c0.238,0,0.431,0.193,0.431,0.431C2.097,15.947,1.904,16.14,1.666,16.14 M18.021,16.14c-0.238,0-0.431-0.192-0.431-0.431c0-0.237,0.192-0.431,0.431-0.431s0.431,0.193,0.431,0.431C18.452,15.947,18.26,16.14,18.021,16.14 M18.452,14.496c-0.136-0.048-0.279-0.078-0.431-0.078c-0.714,0-1.291,0.578-1.291,1.291c0,0.151,0.03,0.295,0.078,0.431H2.878c0.048-0.136,0.079-0.279,0.079-0.431c0-0.713-0.579-1.291-1.292-1.291c-0.151,0-0.295,0.03-0.43,0.078V9.174c0.135,0.048,0.279,0.079,0.43,0.079c0.713,0,1.292-0.578,1.292-1.291c0-0.152-0.031-0.295-0.079-0.431h13.93C16.761,7.667,16.73,7.81,16.73,7.962c0,0.713,0.577,1.291,1.291,1.291c0.151,0,0.295-0.031,0.431-0.079V14.496z M18.021,8.392c-0.238,0-0.431-0.192-0.431-0.43c0-0.238,0.192-0.431,0.431-0.431s0.431,0.192,0.431,0.431C18.452,8.2,18.26,8.392,18.021,8.392 M15.438,14.418h-0.86c-0.238,0-0.431,0.192-0.431,0.43c0,0.238,0.192,0.431,0.431,0.431h0.86c0.238,0,0.431-0.192,0.431-0.431C15.869,14.61,15.677,14.418,15.438,14.418 M9.844,8.392c-1.901,0-3.443,1.542-3.443,3.443s1.542,3.443,3.443,3.443s3.443-1.542,3.443-3.443S11.745,8.392,9.844,8.392 M11.233,13.271c-0.071,0.162-0.169,0.297-0.292,0.403c-0.124,0.108-0.268,0.189-0.434,0.246c-0.166,0.058-0.295,0.089-0.488,0.097v0.4H9.673v-0.4c-0.208-0.004-0.35-0.037-0.522-0.099c-0.174-0.063-0.322-0.151-0.445-0.267s-0.219-0.257-0.286-0.424c-0.067-0.168-0.099-0.361-0.095-0.579h0.659c-0.003,0.256,0.052,0.459,0.168,0.608c0.115,0.147,0.257,0.226,0.522,0.233v-1.417c-0.158-0.042-0.265-0.094-0.422-0.154c-0.156-0.061-0.297-0.139-0.422-0.234c-0.125-0.095-0.226-0.215-0.303-0.36c-0.077-0.144-0.115-0.323-0.115-0.538c0-0.187,0.035-0.352,0.106-0.494c0.072-0.143,0.168-0.261,0.289-0.357c0.121-0.096,0.261-0.168,0.419-0.22C9.383,9.665,9.5,9.64,9.673,9.64V9.256h0.348V9.64c0.173,0,0.287,0.023,0.441,0.07c0.154,0.047,0.288,0.117,0.401,0.211c0.114,0.093,0.204,0.212,0.272,0.356c0.067,0.145,0.101,0.312,0.101,0.503h-0.659c-0.008-0.199-0.059-0.351-0.153-0.457c-0.095-0.105-0.197-0.158-0.404-0.158V11.4c0.173,0.048,0.293,0.103,0.459,0.165c0.166,0.062,0.312,0.142,0.439,0.239c0.127,0.098,0.229,0.219,0.306,0.363c0.077,0.144,0.116,0.321,0.116,0.532C11.341,12.919,11.305,13.109,11.233,13.271M10.458,12.332c-0.067-0.051-0.143-0.092-0.228-0.123c-0.085-0.031-0.123-0.06-0.21-0.082v1.363c0.208-0.016,0.329-0.076,0.462-0.185c0.133-0.107,0.199-0.277,0.199-0.512c0-0.109-0.02-0.2-0.061-0.275C10.581,12.444,10.526,12.383,10.458,12.332 M9.069,10.74c0,0.094,0.019,0.174,0.058,0.241c0.039,0.066,0.087,0.122,0.148,0.169c0.06,0.047,0.128,0.085,0.208,0.114s0.109,0.054,0.19,0.073v-1.171c-0.208,0-0.32,0.044-0.434,0.132C9.126,10.386,9.069,10.533,9.069,10.74"></path>
                      </svg>
                    </div>
                </div>
                <div class="flex-1 text-right md:text-center">
                    <h5 class="font-bold uppercase text-gray-600">Total Revenue</h5>
                    <h3 class="font-bold text-3xl">&#8362;{{ App\Order::getTotalSum($orders->toArray()) }}<span class="text-green-500"><i class="fas fa-caret-up"></i></span></h3>
                </div>
            </div>
        </div>
        <!--/Metric Card-->
    </div>
    <div class="w-full md:w-1/2 xl:w-1/3 p-3">
        <!--Metric Card-->
        <div class="bg-orange-100 border-b-4 border-orange-500 rounded-lg shadow-lg p-5">
            <div class="flex flex-row items-center">
                <div class="flex-shrink pr-4">
                    <div class="rounded-full p-4 bg-orange-600">
                        <svg class="fill-current h-8 svg-icon text-orange-100 w-8" viewBox="0 0 20 20">
							<path d="M15.573,11.624c0.568-0.478,0.947-1.219,0.947-2.019c0-1.37-1.108-2.569-2.371-2.569s-2.371,1.2-2.371,2.569c0,0.8,0.379,1.542,0.946,2.019c-0.253,0.089-0.496,0.2-0.728,0.332c-0.743-0.898-1.745-1.573-2.891-1.911c0.877-0.61,1.486-1.666,1.486-2.812c0-1.79-1.479-3.359-3.162-3.359S4.269,5.443,4.269,7.233c0,1.146,0.608,2.202,1.486,2.812c-2.454,0.725-4.252,2.998-4.252,5.685c0,0.218,0.178,0.396,0.395,0.396h16.203c0.218,0,0.396-0.178,0.396-0.396C18.497,13.831,17.273,12.216,15.573,11.624 M12.568,9.605c0-0.822,0.689-1.779,1.581-1.779s1.58,0.957,1.58,1.779s-0.688,1.779-1.58,1.779S12.568,10.427,12.568,9.605 M5.06,7.233c0-1.213,1.014-2.569,2.371-2.569c1.358,0,2.371,1.355,2.371,2.569S8.789,9.802,7.431,9.802C6.073,9.802,5.06,8.447,5.06,7.233 M2.309,15.335c0.202-2.649,2.423-4.742,5.122-4.742s4.921,2.093,5.122,4.742H2.309z M13.346,15.335c-0.067-0.997-0.382-1.928-0.882-2.732c0.502-0.271,1.075-0.429,1.686-0.429c1.828,0,3.338,1.385,3.535,3.161H13.346z"></path>
						</svg>
                    </div>
                </div>
                <div class="flex-1 text-right md:text-center flex flex-row">
                    <div class="flex-1 flex flex-col">
                        <h5 class="font-bold uppercase text-gray-600 flex-1">Users</h5>
                        <h3 class="font-bold text-3xl flex-1">{{ $roles->count() }}</h3>
                    </div>
                    <div class="flex-1 flex flex-col">
                        <h5 class="font-bold uppercase text-gray-600 flex-1">Admins</h5>
                        <h3 class="font-bold text-3xl flex-1">{{ $roles->where('r_id', 7)->count() }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <!--/Metric Card-->
    </div>
    <div class="w-full md:w-1/2 xl:w-1/3 p-3">
        <!--Metric Card-->
        <div class="bg-yellow-100 border-b-4 border-yellow-600 rounded-lg shadow-lg p-5">
            <div class="flex flex-row items-center">
                <div class="flex-shrink pr-4">
                    <div class="rounded-full p-4 bg-yellow-600">
                        <svg class="fill-current h-8 svg-icon text-yellow-100 w-8" viewBox="0 0 20 20">
							<path fill="" d="M12.443,9.672c0.203-0.496,0.329-1.052,0.329-1.652c0-1.969-1.241-3.565-2.772-3.565S7.228,6.051,7.228,8.02c0,0.599,0.126,1.156,0.33,1.652c-1.379,0.555-2.31,1.553-2.31,2.704c0,1.75,2.128,3.169,4.753,3.169c2.624,0,4.753-1.419,4.753-3.169C14.753,11.225,13.821,10.227,12.443,9.672z M10,5.247c1.094,0,1.98,1.242,1.98,2.773c0,1.531-0.887,2.772-1.98,2.772S8.02,9.551,8.02,8.02C8.02,6.489,8.906,5.247,10,5.247z M10,14.753c-2.187,0-3.96-1.063-3.96-2.377c0-0.854,0.757-1.596,1.885-2.015c0.508,0.745,1.245,1.224,2.076,1.224s1.567-0.479,2.076-1.224c1.127,0.418,1.885,1.162,1.885,2.015C13.961,13.689,12.188,14.753,10,14.753z M10,0.891c-5.031,0-9.109,4.079-9.109,9.109c0,5.031,4.079,9.109,9.109,9.109c5.031,0,9.109-4.078,9.109-9.109C19.109,4.969,15.031,0.891,10,0.891z M10,18.317c-4.593,0-8.317-3.725-8.317-8.317c0-4.593,3.724-8.317,8.317-8.317c4.593,0,8.317,3.724,8.317,8.317C18.317,14.593,14.593,18.317,10,18.317z"></path>
						</svg>
                    </div>
                </div>
                <div class="flex-1 text-right md:text-center">
                    <h5 class="font-bold uppercase text-gray-600">New Users (1 Week)</h5>
                    <h3 class="font-bold text-3xl">{{ DB::table('users')->whereRaw('created_at >= DATE(NOW()) + INTERVAL -7 DAY')->count() }}</h3>
                </div>
            </div>
        </div>
        <!--/Metric Card-->
    </div>
    <div class="w-full md:w-1/2 xl:w-1/3 p-3">
        <!--Metric Card-->
        <div class="bg-blue-100 border-b-4 border-blue-500 rounded-lg shadow-lg p-5">
            <div class="flex flex-row items-center">
                <div class="flex-shrink pr-4">
                    <div class="rounded-full p-4 bg-blue-600">
                        <svg class="fill-current h-8 svg-icon text-blue-100 w-8" viewBox="0 0 20 20">
							<path d="M10.25,2.375c-4.212,0-7.625,3.413-7.625,7.625s3.413,7.625,7.625,7.625s7.625-3.413,7.625-7.625S14.462,2.375,10.25,2.375M10.651,16.811v-0.403c0-0.221-0.181-0.401-0.401-0.401s-0.401,0.181-0.401,0.401v0.403c-3.443-0.201-6.208-2.966-6.409-6.409h0.404c0.22,0,0.401-0.181,0.401-0.401S4.063,9.599,3.843,9.599H3.439C3.64,6.155,6.405,3.391,9.849,3.19v0.403c0,0.22,0.181,0.401,0.401,0.401s0.401-0.181,0.401-0.401V3.19c3.443,0.201,6.208,2.965,6.409,6.409h-0.404c-0.22,0-0.4,0.181-0.4,0.401s0.181,0.401,0.4,0.401h0.404C16.859,13.845,14.095,16.609,10.651,16.811 M12.662,12.412c-0.156,0.156-0.409,0.159-0.568,0l-2.127-2.129C9.986,10.302,9.849,10.192,9.849,10V5.184c0-0.221,0.181-0.401,0.401-0.401s0.401,0.181,0.401,0.401v4.651l2.011,2.008C12.818,12.001,12.818,12.256,12.662,12.412"></path>
						</svg>
                    </div>
                </div>
                <div class="flex-1 text-right md:text-center">
                    <h5 class="font-bold uppercase text-gray-600">Server Uptime</h5>
                    <h3 class="font-bold text-3xl">{{ explode(' up ', explode(', ', shell_exec('uptime'))[0])[1] }}</h3>
                </div>
            </div>
        </div>
        <!--/Metric Card-->
    </div>
    <div class="w-full md:w-1/2 xl:w-1/3 p-3">
        <!--Metric Card-->
        <div class="bg-indigo-100 border-b-4 border-indigo-500 rounded-lg shadow-lg p-5">
            <div class="flex flex-row items-center">
                <div class="flex-shrink pr-4">
                    <div class="rounded-full p-4 bg-indigo-600">
                        <svg class="fill-current h-8 svg-icon text-indigo-100 w-8" viewBox="0 0 20 20">
							<path d="M4.317,16.411c-1.423-1.423-1.423-3.737,0-5.16l8.075-7.984c0.994-0.996,2.613-0.996,3.611,0.001C17,4.264,17,5.884,16.004,6.88l-8.075,7.984c-0.568,0.568-1.493,0.569-2.063-0.001c-0.569-0.569-0.569-1.495,0-2.064L9.93,8.828c0.145-0.141,0.376-0.139,0.517,0.005c0.141,0.144,0.139,0.375-0.006,0.516l-4.062,3.968c-0.282,0.282-0.282,0.745,0.003,1.03c0.285,0.284,0.747,0.284,1.032,0l8.074-7.985c0.711-0.71,0.711-1.868-0.002-2.579c-0.711-0.712-1.867-0.712-2.58,0l-8.074,7.984c-1.137,1.137-1.137,2.988,0.001,4.127c1.14,1.14,2.989,1.14,4.129,0l6.989-6.896c0.143-0.142,0.375-0.14,0.516,0.003c0.143,0.143,0.141,0.374-0.002,0.516l-6.988,6.895C8.054,17.836,5.743,17.836,4.317,16.411"></path>
						</svg>
                    </div>
                </div>
                <div class="flex-1 text-right md:text-center">
                    <h5 class="font-bold uppercase text-gray-600">Total Items</h5>
                    <h3 class="font-bold text-3xl">{{ $products->count() }}</h3>
                </div>
            </div>
        </div>
        <!--/Metric Card-->
    </div>
    <div class="w-full md:w-1/2 xl:w-1/3 p-3">
        <!--Metric Card-->
        <div class="bg-red-100 border-b-4 border-red-500 rounded-lg shadow-lg p-5">
            <div class="flex flex-row items-center">
                <div class="flex-shrink pr-4">
                    <div class="rounded-full p-4 bg-red-600">
                        <svg class="fill-current h-8 svg-icon text-red-100 w-8" viewBox="0 0 20 20">
							<path fill="" d="M9.727,7.292c0.078,0.078,0.186,0.125,0.304,0.125c0.119,0,0.227-0.048,0.304-0.125l1.722-1.722c0.078-0.078,0.126-0.186,0.126-0.305c0-0.237-0.192-0.43-0.431-0.43c-0.118,0-0.227,0.048-0.305,0.126l-0.986,0.987V1.822c0-0.237-0.193-0.43-0.431-0.43s-0.431,0.193-0.431,0.43v4.126L8.614,4.961C8.537,4.884,8.429,4.835,8.31,4.835c-0.238,0-0.43,0.193-0.43,0.43c0,0.119,0.048,0.227,0.126,0.305L9.727,7.292z M18.64,8.279H1.423c-0.475,0-0.861,0.385-0.861,0.86V10c0,0.476,0.386,0.861,0.861,0.861h0.172l1.562,7.421l0.008-0.002c0.047,0.187,0.208,0.328,0.41,0.328h12.912c0.201,0,0.362-0.142,0.409-0.328l0.009,0.002l1.562-7.421h0.173c0.475,0,0.86-0.386,0.86-0.861V9.139C19.5,8.664,19.114,8.279,18.64,8.279 M2.475,10.861h2.958l0.271,1.721H2.837L2.475,10.861z M3.018,13.443h2.823l0.271,1.722H3.38L3.018,13.443z M3.924,17.747l-0.362-1.722h2.687l0.271,1.722H3.924z M9.601,17.747H7.38l-0.271-1.722h2.491V17.747z M9.601,15.165H6.973l-0.271-1.722h2.899V15.165z M9.601,12.582H6.565l-0.271-1.721h3.307V12.582z M12.682,17.747h-2.22v-1.722h2.491L12.682,17.747z M13.09,15.165h-2.628v-1.722h2.899L13.09,15.165z M10.462,12.582v-1.721h3.307l-0.271,1.721H10.462z M16.139,17.747h-2.596l0.271-1.722H16.5L16.139,17.747z M16.683,15.165H13.95l0.271-1.722h2.823L16.683,15.165z M17.226,12.582h-2.867l0.271-1.721h2.958L17.226,12.582z M18.64,10H1.423V9.139H18.64V10z"></path>
						</svg>
                    </div>
                </div>
                <div class="flex-1 text-right md:text-center flex flex-row">
                    <div class="flex-1 flex flex-col">
                        <h5 class="font-bold uppercase text-gray-600 flex-1">Items Sold</h5>
                        <h3 class="font-bold text-3xl flex-1">{{ App\Order::getTotalItems($orders->toArray()) }}</h3>
                    </div>
                    <div class="flex-1 flex flex-col">
                        <h5 class="font-bold uppercase text-gray-600 flex-1">Orders</h5>
                        <h3 class="font-bold text-3xl flex-1">{{ $orders->count() }}<span class="text-red-500"><i class="fas fa-caret-up"></i></span></h3>
                    </div>
                </div>
            </div>
        </div>
        <!--/Metric Card-->
    </div>
</div>


<div class="flex flex-row flex-wrap flex-grow mt-2">

    <div class="w-full md:w-1/2 xl:w-1/3 p-3">
        <!--Graph Card-->
        <div class="bg-white border-transparent h-full rounded-lg shadow-lg">
            <div class="bg-gray-400 uppercase text-gray-800 border-b-2 border-gray-500 rounded-tl-lg rounded-tr-lg p-2">
                <h5 class="font-bold uppercase text-gray-600">Response Time (Now)</h5>
            </div>
            <div class="p-5">
                {{-- <h4 class="text-center mb-3">Response Time (Now) </h4> --}}
                <div class="flex flex-row justify-center justify-evenly">
                    <div class="-ml-3 sm:ml-0 thermometer">
                        <div class="ring">
                          <div class="dial-bottom"></div>
                        </div>
                        <div class="temperatureContainer">
                          <div class="pointer central" style="transform: rotate({{ ($deg > 130) ? 130 : $deg }}deg)"></div>
                          <div class="pointer basking"></div>
                          <div class="mt-6">
                                <h5 class="font-light text-gray-600">Latency:</h5>
                                <aside class="font-light text-2xl text-gray-800">
                                    <span class="{{ ($now <= 1000) ? 'text-green-500' : 'text-red-500' }}">{{ $now }}</span>
                                    <span>ms</span>
                                </aside>
                          </div>
                        </div>
                    </div>
                    <div class="border-l flex flex-col lg:ml-4 ml-1 mt-6 pl-1 xl:pl-10">
                        <div class="flex flex-col mx-auto py-4 font-light">
                            <h6 class="md:text-left text-center text-xs">Daily Avg:</h6>
                            <p class="text-center text-gray-800 text-lg">{{ $todayAvg }}ms</p>
                        </div>
                        <div class="flex flex-col mx-auto py-4 font-light">
                            <h6 class="text-center text-xs">Monthly Avg:</h6>
                            <p class="text-center text-gray-800 text-lg">{{ $monthAvg }}ms</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/Graph Card-->
    </div>

    <div class="w-full md:w-1/2 xl:w-1/3 p-3">
        <!--Graph Card-->
        <div class="bg-white border-transparent h-full rounded-lg shadow-lg">
            <div class="bg-gray-400 border-b-2 border-gray-500 rounded-tl-lg rounded-tr-lg p-2">
                <h5 class="font-bold uppercase text-gray-600">All Visited Routes</h5>
            </div>
            <div class="p-5">
                <canvas id="chartjs-1" class="chartjs" width="undefined" height="undefined" style="min-height: 35vh;"></canvas>
                <script>
                    new Chart(document.getElementById("chartjs-1").getContext('2d'), {
                        type: "bar",
                        data: {
                            labels: {!! json_encode(array_keys($routes), JSON_UNESCAPED_SLASHES) !!},
                            datasets: [{
                                data: {{ json_encode(array_values($routes), JSON_UNESCAPED_SLASHES) }},
                                fill: true,
                                backgroundColor: () => {
                                    const arr = []
                                    for (let index = 0; index < {{ json_encode(array_values($routes), JSON_UNESCAPED_SLASHES) }}.length; index++) {
                                        arr.push(dynamicColors())
                                    }
                                    return arr
                                },
                                borderColor: '#153030',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }, 
                                    scaleLabel: {
                                        display: true,
                                        labelString: 'Requests Count'
                                    }
                                }],
                                xAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }, 
                                    scaleLabel: {
                                        display: true,
                                        labelString: 'Routes'
                                    }
                                }]
                            },
                            legend: {
                                display: false
                            }
                        }
                    });
                </script>
            </div>
        </div>
        <!--/Graph Card-->
    </div>

    <div class="w-full md:w-1/2 xl:w-1/3 p-3">
        <!--Graph Card-->
        <div class="bg-white border-transparent h-full rounded-lg shadow-lg">
            <div class="bg-gray-400 uppercase text-gray-800 border-b-2 border-gray-500 rounded-tl-lg rounded-tr-lg p-2">
                <h5 class="font-bold uppercase text-gray-600">Revenues (Items Sold / Orders)</h5>
            </div>
            <div class="p-5">
                <canvas id="chartjs-2" class="chartjs" width="undefined" height="undefined" style="min-height: 35vh;"></canvas>
                <script>
                    new Chart(document.getElementById("chartjs-2").getContext('2d'), {
                        type: "bar",
                        data: {
                            labels: [ months[{{ (int)gmdate('n', strtotime('-3 month', time()))-1 }}],months[{{ (int)gmdate('n', strtotime('-2 month', time()))-1 }}],months[{{ (int)gmdate('n', strtotime('-1 month', time()))-1 }}], months[{{ (int)date('n')-1 }}] ],
                            datasets: [{
                                label: "Items Sold",
                                data: {{ json_encode(array_values($monthlyItemCount), JSON_UNESCAPED_SLASHES) }},
                                borderColor: "rgb(255, 99, 132)",
                                backgroundColor: "rgba(255, 99, 132, 0.2)"
                            }, {
                                label: "Orders",
                                data: {{ json_encode(array_values($monthlyOrderCount), JSON_UNESCAPED_SLASHES) }},
                                type: "line",
                                fill: false,
                                borderColor: "rgb(54, 162, 235)"
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true,
                                        stepSize: 1
                                    }
                                }]
                            }
                        }
                    });
                </script>
            </div>
        </div>
        <!--/Graph Card-->
    </div>

    <div class="w-full md:w-1/2 xl:w-1/3 p-3">
        <!--Graph Card-->
        <div class="bg-white border-transparent h-full rounded-lg shadow-lg">
            <div class="bg-gray-400 border-b-2 border-gray-500 rounded-tl-lg rounded-tr-lg p-2">
                <h5 class="font-bold uppercase text-gray-600">Total Traffic Requests (200, 401, 404)</h5>
            </div>
            <div class="p-5">
                <canvas id="chartjs-3" class="chartjs" width="undefined" height="undefined" style="min-height: 35vh;"></canvas>
                <script>
                    const labelsGen = () => {
                        const arr = []
                        const interval = 30;
                        const period = 2 * 24;
                        const currentDate = new Date();
                        for (let index = period; index >= 0; index--) {
                            const futureDate = new Date(currentDate.getTime() - ((interval * 60000) * index))
                            if (
                                (futureDate.getHours() === 2 && futureDate.getMinutes() <= 30) ||
                                (futureDate.getHours() === 4 && futureDate.getMinutes() <= 30) ||
                                (futureDate.getHours() === 6 && futureDate.getMinutes() <= 30) ||
                                (futureDate.getHours() === 8 && futureDate.getMinutes() <= 30) ||
                                (futureDate.getHours() === 10 && futureDate.getMinutes() <= 30) ||
                                (futureDate.getHours() === 12 && futureDate.getMinutes() <= 30) ||
                                (futureDate.getHours() === 14 && futureDate.getMinutes() <= 30) ||
                                (futureDate.getHours() === 16 && futureDate.getMinutes() <= 30) ||
                                (futureDate.getHours() === 18 && futureDate.getMinutes() <= 30) ||
                                (futureDate.getHours() === 20 && futureDate.getMinutes() <= 30) ||
                                (futureDate.getHours() === 22 && futureDate.getMinutes() <= 30)
                            ) {
                                arr.push(`${((futureDate.getHours() < 10) ? `0${futureDate.getHours()}` : futureDate.getHours())}h`)
                            } else if (futureDate.getHours() === 0 && futureDate.getMinutes() <= 30) {
                                arr.push(`${((futureDate.getDate() < 10) ? `0${futureDate.getDate()}` : futureDate.getDate())}-${((futureDate.getMonth() < 10) ? `0${futureDate.getMonth()}` : futureDate.getMonth())}`)
                            } else {
                                arr.push('')
                            }
                        }
                        return arr
                    }
                    new Chart(document.getElementById("chartjs-3").getContext('2d'), {
                        type: "bar",
                        data: {
                            labels: labelsGen(),
                            datasets: [{
                                label: "Successful Requests (200)",
                                data: {{ json_encode(array_values($requestsCount200), JSON_UNESCAPED_SLASHES) }},
                                backgroundColor: "rgba(75, 192, 192, 0.3)"
                            }, {
                                label: "Unauthorized Requests (401)",
                                data: {{ json_encode(array_values($requestsCount401), JSON_UNESCAPED_SLASHES) }},
                                backgroundColor: "rgba(55, 19, 192, 0.3)"
                            }, {
                                label: "Not Found Requests (404)",
                                data: {{ json_encode(array_values($requestsCount404), JSON_UNESCAPED_SLASHES) }},
                                backgroundColor: "rgba(35, 19, 19, 0.3)"
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                yAxes: [{
                                    stacked: false,
                                    ticks: {
                                        beginAtZero: true,
                                        stepSize: 1
                                    }
                                }],
                                xAxes: [{
                                    stacked: true,
                                    scaleLabel: {
                                        display: true,
                                        labelString: 'Time (Last 24h)'
                                    }
                                }]
                            }
                        }
                    });
                </script>
            </div>
        </div>
        <!--/Graph Card-->
    </div>

    <div class="w-full md:w-1/2 xl:w-1/3 p-3">
        <!--Graph Card-->
        <div class="bg-white border-transparent h-full rounded-lg shadow-lg">
            <div class="bg-gray-400 border-b-2 border-gray-500 rounded-tl-lg rounded-tr-lg p-2">
                <h5 class="font-bold uppercase text-gray-600">Mobile Vs. Desktop</h5>
            </div>
            <div class="p-5"><canvas id="chartjs-4" class="chartjs" width="undefined" height="undefined" style="min-height: 35vh;"></canvas>
                <script>
                    new Chart(document.getElementById("chartjs-4").getContext('2d'), {
                        type: "pie",
                        data: {
                            labels: ['Desktop', 'Mobile'],
                            datasets: [{
                                label: "Issues",
                                data: {{ json_encode(array_values($mobileVsDesktop), JSON_UNESCAPED_SLASHES) }},
                                backgroundColor: ["rgb(255, 99, 132)", "rgb(54, 162, 235)"]
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false
                        }
                    });
                </script>
            </div>
        </div>
        <!--/Graph Card-->
    </div>

    <div class="w-full md:w-1/2 xl:w-1/3 p-3">
        <!--Table Card-->
        <div class="bg-white border-transparent h-full rounded-lg shadow-lg">
            <div class="bg-gray-400 border-b-2 border-gray-500 rounded-tl-lg rounded-tr-lg p-2">
                <h5 class="font-bold uppercase text-gray-600">Request Origin</h5>
            </div>
            <div class="p-5" style="min-height: 35vh;"><canvas id="chartjs-5" class="chartjs" width="undefined" height="undefined"></canvas>
                <script>
                    new Chart(document.getElementById("chartjs-5"), {
                        type: "doughnut",
                        data: {
                            labels: {!! json_encode(array_keys($geos), JSON_UNESCAPED_SLASHES) !!},
                            datasets: [{
                                label: "Issues",
                                data: {{ json_encode(array_values($geos), JSON_UNESCAPED_SLASHES) }},
                                backgroundColor: () => {
                                    const arr = []
                                    for (let index = 0; index < {{ json_encode(array_values($geos), JSON_UNESCAPED_SLASHES) }}.length; index++) {
                                        arr.push(dynamicColors())
                                    }
                                    return arr
                                }
                            }]
                        }, 
                        options: {
                            legend: {
                                display: false
                            },
                        }
                    });
                </script>
                <table class="w-full p-5 mt-5 text-gray-700">
                    <thead>
                        <tr>
                            <th class="text-left text-blue-900">Location</th>
                            <th class="text-left text-blue-900">Count</th>
                            <th class="text-left text-blue-900">Percentage</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($geos as $location=>$count)
                            <tr>
                                <td>{{ $location }}</td>
                                <td>{{ $count }}</td>
                                <td>{{ round((($count/count($logs)) * 100), 1) }}%</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!--/table Card-->
    </div>
</div> 


@endsection

@section('jsdependancy')
    @parent
@endsection