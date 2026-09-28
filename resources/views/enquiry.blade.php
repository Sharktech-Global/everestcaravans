@extends('layouts.app')

@section('content')
    <section class="hero set-bg min-height-450 overlay"
        data-setbg="{{ @$page->banner_image ? asset('storage/' . $page->banner_image) : asset('assets/images/background/default.png') }}">
        <div class="container">
            <div class="row">
                <h1 class="text-white text-center col-md-12">Enquiry</h1>
                <div class="breadcrumbs col-md-12 text-center">
                    <p class="text-white"><a href="{{ route('home') }}">Home</a> <i class="mx-2 fa fa-angle-right"
                            aria-hidden="true"></i>
                        <span>Enquiry</span>
                    </p>
                </div>
            </div>
        </div>
    </section>
    <main id="content">
        <section class="bg-black pb-0" id='contact'>

            @if (@$page->branch_helpline || @$page->contact_person)
                <div class="container mb-5">
                    <div class="row">
                        <div class="col-md-12">

                            <div id="ftabs">
                                <nav>
                                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">

                                        <a class="nav-item nav-link active" id="nav-sales-tab" data-toggle="tab"
                                            href="#nav-sales" role="tab" aria-controls="nav-sales"
                                            aria-selected="true">
                                            <h3 class="">SALES</h3>
                                        </a>
                                        <a class="nav-item nav-link" id="nav-service-tab" data-toggle="tab"
                                            href="#nav-service" role="tab" aria-controls="nav-service"
                                            aria-selected="false">
                                            <h3 class="">SERVICE</h3>
                                        </a>
                                        <a class="nav-item nav-link" id="nav-popular-usedcars-tab" data-toggle="tab"
                                            href="#nav-popular-usedcars" role="tab" aria-controls="nav-popular-usedcars"
                                            aria-selected="false">
                                            <h3 class="">POPULAR USED CARS</h3>
                                        </a>
                                        <a class="nav-item nav-link" id="nav-maruti-driving-schools-tab" data-toggle="tab"
                                            href="#nav-maruti-driving-schools" role="tab" aria-controls="nav-maruti-driving-schools"
                                            aria-selected="false">
                                            <h3 class="">MARUTI DRIVING SCHOOLS</h3>
                                        </a>
                                    </div>
                                </nav>
                                <div class="tab-content px-3 px-sm-0 text-center" id="nav-tabContent">

                                    <div class="tab-pane fade show active" id="nav-sales" role="tabpanel" aria-labelledby="nav-sales-tab">

                                        <div class="bs-sales">
                                            <div class="accordion" id="accordion-sales">
                                                <div class="card">
                                                    <div class="card-header" id="heading-showroom">
                                                        <h2 class="mb-0">
                                                            <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne">
                                                            <i class="fa fa-plus"></i> SHOWROOMS</button>
                                                        </h2>
                                                    </div>
                                                    <div id="collapseOne" class="collapse show" aria-labelledby="heading-showroom" data-parent="#accordion-sales">
                                                        <div class="card-body">
                                                            <table id="tablepress-6" class="table table-responsive w-100">
                                                                <thead>
                                                                <tr class="row-1 odd" role="row"><th class="column-1 sorting_disabled" rowspan="1" colspan="1" style="width: 38.8281px;">&nbsp;</th><th class="column-2 sorting_disabled" rowspan="1" colspan="1" style="width: 258.609px;">Branches</th><th class="column-3 sorting_disabled" rowspan="1" colspan="1" style="width: 388.844px;">Branch Heads</th><th class="column-4 sorting_disabled" rowspan="1" colspan="1" style="width: 437.719px;">Branch Address</th></tr>
                                                                </thead>
                                                                <tbody class="row-hover">
                                                                <tr class="row-2 even" role="row">
                                                                <td class="column-1">1</td><td class="column-2">Chennai Showroom<br>
                                                                <a href="https://www.google.com/maps/place/Popular+Vehicles+%26+Services+Limited,+No-16,Block+3rd+Avenue/@13.09088,80.218445,18z/data=!4m2!3m1!1s0x0:0x7fc9be9c758a1b2f?hl=en-US" target="_blank" rel="noopener noreferrer">View Map</a></td><td class="column-3">Mr.Rajkumar<br>
                                                                Head Customer Acquisition<br>
                                                                9282139768<br>
                                                                rajkumar@popularv.com </td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                No-16, Block 3rd Avenue<br>
                                                                Anna Nagar East, Chennai – 600 102<br>
                                                                Ph No. 044-26191934</td>
                                                                </tr><tr class="row-3 odd" role="row">
                                                                <td class="column-1">2</td><td class="column-2">Pallikaranai Showroom<br>
                                                                <a href="https://g.page/Maruti-cars-Pallikaranai?share" target="_blank" rel="noopener noreferrer">View Map</a></td><td class="column-3">Mr.Rajkumar<br>
                                                                Head Customer Acquisition<br>
                                                                9282139768<br>
                                                                rajkumar@popularv.com </td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                Velachery Main Rd, near Kamakashi Hospital,<br>
                                                                Sai Balaji Nagar, Thai Nagar, Karapagambal Nagar,<br>
                                                                Pallikaranai, Chennai, 600100<br>
                                                                Ph No - 091769 06330<br>
                                                                </td>
                                                                </tr><tr class="row-4 even" role="row">
                                                                <td class="column-1">3</td><td class="column-2">Calicut Showroom<br>
                                                                <a href="https://www.google.com/maps/place/Popular+Vehicles+And+Services+Limited/@11.281309,75.787317,14z/data=!4m2!3m1!1s0x0:0xc8612cd71b287ae7?hl=en-US" target="_blank" rel="noopener noreferrer">View Map</a></td><td class="column-3">Nikhil T<br>
                                                                Branch Head<br>
                                                                8086073443<br>
                                                                nikhilt@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                Civil Station P.O., Wynad Road,<br>
                                                                Kozhikode – 673 020<br>
                                                                Ph. No. 0495 2370070/71<br>
                                                                </td>
                                                                </tr><tr class="row-5 odd" role="row">
                                                                <td class="column-1">4</td><td class="column-2">Kottayam Showroom<br>
                                                                <a href="https://g.page/Maruti-cars-Kottayam?gm" target="_blank" rel="noopener noreferrer">View Map</a></td><td class="column-3">Manoranjan T R<br>
                                                                Branch Head<br>
                                                                9946104646<br>
                                                                </td><td class="column-4">Popular Vehicles &amp; Services  Ltd.<br>
                                                                Near St Thomas Orthdox Church<br>
                                                                Chavittuvary, S H Mount P.O.<br>
                                                                Kottayam - 06<br>
                                                                Ph No. (0481) 2310800, 6614550-60<br>
                                                                </td>
                                                                </tr><tr class="row-6 even" role="row">
                                                                <td class="column-1">5</td><td class="column-2"><a href="https://www.popularmaruti.com/arena-kochi/" style="color: #5e5e5e;">Mamangalam Showroom</a><br>
                                                                <a href="https://www.google.com/maps/place/Popular+Vehicles+%26+Services+Ltd,+Corporate+Office,+Kuttukaran+Centre/@10.009398,76.304108,16z/data=!4m2!3m1!1s0x0:0xeb5f43c43fbcc6fe?hl=en-US" target="_blank" rel="noopener noreferrer">View Map</a></td><td class="column-3">Mr. Nidheesh<br>
                                                                Branch Head<br>
                                                                8086072406<br>
                                                                nidheesh@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                Kuttukaran Centre,<br>
                                                                Mamangalam, Cochin/Kochi – 25<br>
                                                                Ph. No. 0484- 4092000, 8589992500</td>
                                                                </tr><tr class="row-7 odd" role="row">
                                                                <td class="column-1">6</td><td class="column-2">Trivandrum Showroom<br>
                                                                <a href="https://www.google.com/maps/place/Popular+Vehicles+And+Service+Ltd,+Kuttulcaran+Complex,+Karamana,+Karamana/@8.48115,76.960025,18z/data=!4m2!3m1!1s0x0:0x2211fee9c73d00ff?hl=en-US" target="_blank" rel="noopener noreferrer">View Map</a><br>
                                                                </td><td class="column-3">Rajeev Sreedharan<br>
                                                                Branch Head<br>
                                                                99471 12290 rajeev.sreedharan@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                Kuttukaran Complex<br>
                                                                Karamana P.O., Killippalam,<br>
                                                                Tvm – 695 002<br>
                                                                Ph No. (0471) 4091111 9846397080accts<br>
                                                                </td>
                                                                </tr><tr class="row-8 even" role="row">
                                                                <td class="column-1">7</td><td class="column-2">Thrissur Showroom<br>
                                                                <a href="https://www.google.com/maps/place/Popular+Vehicles+and+Services+Ltd/@10.542632,76.214085,18z/data=!4m2!3m1!1s0x0:0xdc4432df7c3dfa93?hl=en-US" target="_blank" rel="noopener noreferrer">View Map</a></td><td class="column-3">Harikumaran<br>
                                                                Branch Head<br>
                                                                98468 88755<br>
                                                                harikumaran@popularv.com </td><td class="column-4">Popular Vehicles &amp; Services  Ltd.<br>
                                                                Tuda Road<br>
                                                                Peringavu,Thiruvambadi<br>
                                                                Thrissur-680002<br>
                                                                Ph No-0487-2327541,42,43</td>
                                                                </tr><tr class="row-9 odd" role="row">
                                                                <td class="column-1">8</td><td class="column-2">Kannur Showroom<br>
                                                                <a href="https://g.page/Maruti-cars-kannur?share" target="_blank" rel="noopener noreferrer">View Map</a></td><td class="column-3">Shamir Ahamed<br>
                                                                Branch Head<br>
                                                                85899 92489<br>
                                                                shamir.ahamed@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services  Ltd.<br>
                                                                NH 66, opp. Classic Marbles,<br>
                                                                Pallikkunnu,<br>
                                                                Kannur,<br>
                                                                Kerala 670004</td>
                                                                </tr></tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header" id="heading-trivandrum">
                                                        <h2 class="mb-0">
                                                            <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo">
                                                            <i class="fa fa-plus"></i> E-outlets & SPCs TRIVANDRUM</button>
                                                        </h2>
                                                    </div>
                                                    <div id="collapseTwo" class="collapse" aria-labelledby="heading-trivandrum" data-parent="#accordion-sales">
                                                        <div class="card-body">
                                                            <table id="tablepress-100" class="table table-responsive w-100">
                                                                <thead>
                                                                <tr class="row-1 odd" role="row"><th class="column-1 sorting_disabled" rowspan="1" colspan="1" style="width: 20px;">Sl No</th><th class="column-2 sorting_disabled" rowspan="1" colspan="1" style="width: 155px;">Name Of Spc</th><th class="column-3 sorting_disabled" rowspan="1" colspan="1" style="width: 235px;">Name Of Spc Head</th><th class="column-4 sorting_disabled" rowspan="1" colspan="1" style="width: 265px;">Address</th></tr>
                                                                </thead>
                                                                <tbody class="row-hover">
                                                                <tr class="row-2 even" role="row">
                                                                <td class="column-1">1</td><td class="column-2">Attingal&nbsp;</td><td class="column-3">Ratheesh Kumar S<br>
                                                                8943345914<br>
                                                                atisat@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                Malika Tower,Opp Mosque,<br>
                                                                Alamcode Po,Attingal<br>
                                                                </td>
                                                                </tr><tr class="row-3 odd" role="row">
                                                                <td class="column-1">2</td><td class="column-2">Anchal</td><td class="column-3">Sooraj s<br>
                                                                9946104668<br>
                                                                acl.spm.head@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                Near East HSS OPP Royal Textiles,<br>
                                                                Anchal Punalur  Road,Anchal</td>
                                                                </tr><tr class="row-4 even" role="row">
                                                                <td class="column-1">3</td><td class="column-2">Balaramapuram</td><td class="column-3">Rakesh R K<br>
                                                                8589992400<br>
                                                                blr.spm.head@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                Poovar Road,Vazhimukku<br>
                                                                Balaramapuram</td>
                                                                </tr><tr class="row-5 odd" role="row">
                                                                <td class="column-1">4</td><td class="column-2">Bharanikavu</td><td class="column-3">Rajesh Kumar s<br>
                                                                8589992531<br>
                                                                sm2tvm@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                Adoor Road, Near Cashew Factory<br>
                                                                Bharanikkavu</td>
                                                                </tr><tr class="row-6 even" role="row">
                                                                <td class="column-1">5</td><td class="column-2">Karunagapally</td><td class="column-3">Shanavas<br>
                                                                9946104634<br>
                                                                knpsat@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                Udaya Building, Karunagapally<br>
                                                                Govt.Hospital Junction ,Karunagappally</td>
                                                                </tr><tr class="row-7 odd" role="row">
                                                                <td class="column-1">6</td><td class="column-2">Kattakkada</td><td class="column-3">Vimal Singh <br>
                                                                8086072436<br>
                                                                ktdsat@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                Shalom Building,Choondupalaka<br>
                                                                Kattakkada Po<br>
                                                                </td>
                                                                </tr><tr class="row-8 even" role="row">
                                                                <td class="column-1">7</td><td class="column-2">Kollam</td><td class="column-3">Sanil Kumar P<br>
                                                                9539007348<br>
                                                                qlnsat@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                H&amp;C Compound,Mundakkal West,<br>
                                                                Kollam</td>
                                                                </tr><tr class="row-9 odd" role="row">
                                                                <td class="column-1">8</td><td class="column-2">Kottarakkara</td><td class="column-3">Sajeev M S<br>
                                                                9846498604<br>
                                                                kotsat@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                Near Kip Quarters,Pulamon Po<br>
                                                                Kottarakkara</td>
                                                                </tr><tr class="row-10 even" role="row">
                                                                <td class="column-1">9</td><td class="column-2">Nedumangadu</td><td class="column-3">Naz A N<br>
                                                                9946104667<br>
                                                                nddsat@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                Al-Hiba Tower, Near Federal Bank, Kallingal Jn.<br>
                                                                Nedumangad, TVM</td>
                                                                </tr><tr class="row-11 odd" role="row">
                                                                <td class="column-1">10</td><td class="column-2">Neyyattinakra</td><td class="column-3">Sarath S V<br>
                                                                9539009755<br>
                                                                ntasat@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                Saira Building ,Near Hanuman Temple<br>
                                                                Neyyattinakra</td>
                                                                </tr><tr class="row-12 even" role="row">
                                                                <td class="column-1">11</td><td class="column-2">Parassala</td><td class="column-3">Dinu <br>
                                                                8086073450<br>
                                                                pslasat@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                Mathrakkal Complex<br>
                                                                Parasuvaikkal Jn<br>
                                                                Parassala</td>
                                                                </tr><tr class="row-13 odd" role="row">
                                                                <td class="column-1">12</td><td class="column-2">Pathanapuram</td><td class="column-3">Ajeesh R<br>
                                                                9847278548<br>
                                                                pth.spm.head@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                Rahumaniya Complex,<br>
                                                                Nadukunnu P O,<br>
                                                                Pathanapuram</td>
                                                                </tr><tr class="row-14 even" role="row">
                                                                <td class="column-1">13</td><td class="column-2">Punalur</td><td class="column-3">Sales Head <br>
                                                                9072609443<br>
                                                                pnlrsat@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                Union Building Near Krishnan Kovil<br>
                                                                Punalur</td>
                                                                </tr><tr class="row-15 odd" role="row">
                                                                <td class="column-1">14</td><td class="column-2">Varkala</td><td class="column-3">Sales Head <br>
                                                                8589992387<br>
                                                                vrk.spm@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                Near Vettoor Village Office<br>
                                                                Kadakkavoor Po<br>
                                                                Puthenchantha, Varkala,</td>
                                                                </tr><tr class="row-16 even" role="row">
                                                                <td class="column-1">15</td><td class="column-2">Venjaramoodu</td><td class="column-3">Ratheesh Kumar S<br>
                                                                8086072434<br>
                                                                vjm.spm.head@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                Near Bsnl Office<br>
                                                                Attingal Road, Venjaramoodu Tvm,&nbsp;<br>
                                                                8086072434</td>
                                                                </tr></tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header" id="heading-kottayam">
                                                        <h2 class="mb-0">
                                                            <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree">
                                                            <i class="fa fa-plus"></i> E-outlets & SPCs KOTTAYAM</button>
                                                        </h2>
                                                    </div>
                                                    <div id="collapseThree" class="collapse" aria-labelledby="heading-kottayam" data-parent="#accordion-sales">
                                                        <div class="card-body">
                                                            <table id="tablepress-117" class="table table-responsive w-100">
                                                                <thead>
                                                                <tr class="row-1 odd" role="row"><th class="column-1 sorting" tabindex="0" aria-controls="tablepress-117" rowspan="1" colspan="1" aria-label="SL NO: activate to sort column ascending" style="width: 20px;">SL NO</th><th class="column-2 sorting" tabindex="0" aria-controls="tablepress-117" rowspan="1" colspan="1" aria-label="Name of SPC: activate to sort column ascending" style="width: 155px;">Name of SPC</th><th class="column-3 sorting" tabindex="0" aria-controls="tablepress-117" rowspan="1" colspan="1" aria-label="NAME OF SPC HEAD: activate to sort column ascending" style="width: 235px;">NAME OF SPC HEAD</th><th class="column-4 sorting" tabindex="0" aria-controls="tablepress-117" rowspan="1" colspan="1" aria-label="ADDRESS: activate to sort column ascending" style="width: 265px;">ADDRESS</th></tr>
                                                                </thead>
                                                                <tbody class="row-hover">
                                                                <tr class="row-2 even" role="row">
                                                                <td class="column-1">1</td><td class="column-2">ADOOR</td><td class="column-3">Sales Head<br>
                                                                8086078746<br>
                                                                adrsat@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                Punthalayathu Building,<br>
                                                                Nellimoottilpadi, Adoor<br>
                                                                Mob: 9946104603</td>
                                                                </tr><tr class="row-3 odd" role="row">
                                                                <td class="column-1">2</td><td class="column-2">CHENGANNOOR</td><td class="column-3">Sales Head<br>
                                                                8589992687<br>
                                                                cgnrsat@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                Kokkaparampil Building,<br>
                                                                Near Railway Overbridge,<br>
                                                                Mc Road Chengannur<br>
                                                                Mob: 8086898018</td>
                                                                </tr><tr class="row-4 even" role="row">
                                                                <td class="column-1">3</td><td class="column-2">KANJIRAPALLY</td><td class="column-3">Sales Head<br>
                                                                8589992455<br>
                                                                knplysat@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                Opp. AKJM School,<br>
                                                                Kanjirapally po, Kanjirapally,<br>
                                                                Mob: 8086898023</td>
                                                                </tr><tr class="row-5 odd" role="row">
                                                                <td class="column-1">4</td><td class="column-2">KARUKACHAL</td><td class="column-3">Sales Head<br>
                                                                8086072488<br>
                                                                krchlsat@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                Thoompunkal Plaza,<br>
                                                                Near Panchayath office, Changanacherry<br>
                                                                Mob: 8086898024</td>
                                                                </tr><tr class="row-6 even" role="row">
                                                                <td class="column-1">5</td><td class="column-2">KAYAMKULAM</td><td class="column-3">Sales Head<br>
                                                                8086072455<br>
                                                                kyklmsat@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                N.H-47, Kottukulangara po,<br>
                                                                Kayamkulam<br>
                                                                Mob: 9846498659</td>
                                                                </tr><tr class="row-7 odd" role="row">
                                                                <td class="column-1">6</td><td class="column-2">MAVELIKKARA</td><td class="column-3">Sales Head<br>
                                                                8589992379<br>
                                                                mvksat@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                Srambickal Building,<br>
                                                                Prayikara, Mavelikkara<br>
                                                                Mob: 8086898017</td>
                                                                </tr><tr class="row-8 even" role="row">
                                                                <td class="column-1">7</td><td class="column-2">MAVELIKKARA WORK SHOP</td><td class="column-3">Sales Head<br>
                                                                8589998106<br>
                                                                mvkrawsat@popularv.om</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                Konnayil Suvako Industrial Complex,<br>
                                                                A One Industrial Estate, Kallumel po,<br>
                                                                Kochalummoodu, Mavelikkara,<br>
                                                                Mob: 8086078800</td>
                                                                </tr><tr class="row-9 odd" role="row">
                                                                <td class="column-1">8</td><td class="column-2">PALA</td><td class="column-3">Sales Head<br>
                                                                8086072475<br>
                                                                palasat@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                Vypana building, Oorassala Junction Arunapuram , Pala<br>
                                                                Mob: 9946105640</td>
                                                                </tr><tr class="row-10 even" role="row">
                                                                <td class="column-1">9</td><td class="column-2">PANDALAM</td><td class="column-3">Sales Head<br>
                                                                8086072489<br>
                                                                pdlmsat@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                Valiyathans Tower, Near Pandalam Palace,<br>
                                                                M C Road Pandalam<br>
                                                                Mob: 8589992598</td>
                                                                </tr><tr class="row-11 odd" role="row">
                                                                <td class="column-1">10</td><td class="column-2">PATHANAMTHITTA</td><td class="column-3">Sales Head<br>
                                                                8086072484<br>
                                                                pthasat@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                Valayil Building, Near St Peters Church, <br>
                                                                Nannuvakadu Junction,<br>
                                                                Pathanamthitta<br>
                                                                Mob: 9846970260</td>
                                                                </tr><tr class="row-12 even" role="row">
                                                                <td class="column-1">11</td><td class="column-2">PATHANAMTHITTA WORK SHOP</td><td class="column-3">Sales Head<br>
                                                                8589992371<br>
                                                                ptawsat@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                Near Collectorate, Opp. Gurumandiram,<br>
                                                                Pathanamthitta<br>
                                                                Mob: 9072609502</td>
                                                                </tr><tr class="row-13 odd" role="row">
                                                                <td class="column-1">12</td><td class="column-2">RANNI</td><td class="column-3">Sales Head<br>
                                                                8943345982<br>
                                                                rannisat@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                Valiyamannil Building, Opp Indian Oil Pump,<br>
                                                                Pazhavangady, Ranni<br>
                                                                Mob: 9846435250</td>
                                                                </tr><tr class="row-14 even" role="row">
                                                                <td class="column-1">13</td><td class="column-2">THIRUVALLA</td><td class="column-3">Sales Head<br>
                                                                8086078747<br>
                                                                trvlsat@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                Oppst. Erankavu Temple <br>
                                                                Kavumbhagom, Thiruvalla<br>
                                                                Mob: 8086072450</td>
                                                                </tr><tr class="row-15 odd" role="row">
                                                                <td class="column-1">14</td><td class="column-2">THIRUVALLA&nbsp; WORK SHOP</td><td class="column-3">Sales Head<br>
                                                                8086072461<br>
                                                                ws.trvla@populaarv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                Oppst. Erankavu Temple<br>
                                                                Kavumbhagom, Thiruvalla<br>
                                                                Mob: 8086072450</td>
                                                                </tr><tr class="row-16 even" role="row">
                                                                <td class="column-1">15</td><td class="column-2">VAIKOM</td><td class="column-3">Sales Head<br>
                                                                8086078742<br>
                                                                vkmsat@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                Vaikom Kuries Building, Opp.Union Bank,<br>
                                                                Valiyakavala, Vaikom<br>
                                                                Mob: 9846895548</td>
                                                                </tr><tr class="row-17 odd" role="row">
                                                                <td class="column-1">16</td><td class="column-2">PALA WORK SHOP</td><td class="column-3">Sales Head<br>
                                                                8943345931<br>
                                                                ws.pala@popularv.com</td><td class="column-4">Popular Vehicles And Services Ltd,<br>
                                                                12th Mile, P.P.Road Pala<br>
                                                                Mob: 9072609543</td>
                                                                </tr><tr class="row-18 even" role="row">
                                                                <td class="column-1">17</td><td class="column-2">KAYAMKULAM WORK SHOP</td><td class="column-3">Sales Head<br>
                                                                8086072468<br>
                                                                ws.kyklm@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                N.H-47, Kottukulangara po,<br>
                                                                Kayamkulam<br>
                                                                Mob: 9846498659</td>
                                                                </tr></tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header" id="heading-kochi">
                                                        <h2 class="mb-0">
                                                            <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsekochi">
                                                            <i class="fa fa-plus"></i> E-outlets & SPCs KOCHI</button>
                                                        </h2>
                                                    </div>
                                                    <div id="collapsekochi" class="collapse" aria-labelledby="heading-kochi" data-parent="#accordion-sales">
                                                        <div class="card-body">
                                                            <table id="tablepress-117" class="table table-responsive w-100">
                                                                <thead>
                                                                <tr class="row-1 odd" role="row"><th class="column-1 sorting" tabindex="0" aria-controls="tablepress-117" rowspan="1" colspan="1" aria-label="SL NO: activate to sort column ascending" style="width: 20px;">SL NO</th><th class="column-2 sorting" tabindex="0" aria-controls="tablepress-117" rowspan="1" colspan="1" aria-label="Name of SPC: activate to sort column ascending" style="width: 155px;">Name of SPC</th><th class="column-3 sorting" tabindex="0" aria-controls="tablepress-117" rowspan="1" colspan="1" aria-label="NAME OF SPC HEAD: activate to sort column ascending" style="width: 235px;">NAME OF SPC HEAD</th><th class="column-4 sorting" tabindex="0" aria-controls="tablepress-117" rowspan="1" colspan="1" aria-label="ADDRESS: activate to sort column ascending" style="width: 265px;">ADDRESS</th></tr>
                                                                </thead>
                                                                <tbody class="row-hover">
                                                                <tr class="row-2 even" role="row">
                                                                <td class="column-1">1</td><td class="column-2">ADOOR</td><td class="column-3">Sales Head<br>
                                                                8086078746<br>
                                                                adrsat@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                Punthalayathu Building,<br>
                                                                Nellimoottilpadi, Adoor<br>
                                                                Mob: 9946104603</td>
                                                                </tr><tr class="row-3 odd" role="row">
                                                                <td class="column-1">2</td><td class="column-2">CHENGANNOOR</td><td class="column-3">Sales Head<br>
                                                                8589992687<br>
                                                                cgnrsat@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                Kokkaparampil Building,<br>
                                                                Near Railway Overbridge,<br>
                                                                Mc Road Chengannur<br>
                                                                Mob: 8086898018</td>
                                                                </tr><tr class="row-4 even" role="row">
                                                                <td class="column-1">3</td><td class="column-2">KANJIRAPALLY</td><td class="column-3">Sales Head<br>
                                                                8589992455<br>
                                                                knplysat@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                Opp. AKJM School,<br>
                                                                Kanjirapally po, Kanjirapally,<br>
                                                                Mob: 8086898023</td>
                                                                </tr><tr class="row-5 odd" role="row">
                                                                <td class="column-1">4</td><td class="column-2">KARUKACHAL</td><td class="column-3">Sales Head<br>
                                                                8086072488<br>
                                                                krchlsat@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                Thoompunkal Plaza,<br>
                                                                Near Panchayath office, Changanacherry<br>
                                                                Mob: 8086898024</td>
                                                                </tr><tr class="row-6 even" role="row">
                                                                <td class="column-1">5</td><td class="column-2">KAYAMKULAM</td><td class="column-3">Sales Head<br>
                                                                8086072455<br>
                                                                kyklmsat@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                N.H-47, Kottukulangara po,<br>
                                                                Kayamkulam<br>
                                                                Mob: 9846498659</td>
                                                                </tr><tr class="row-7 odd" role="row">
                                                                <td class="column-1">6</td><td class="column-2">MAVELIKKARA</td><td class="column-3">Sales Head<br>
                                                                8589992379<br>
                                                                mvksat@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                Srambickal Building,<br>
                                                                Prayikara, Mavelikkara<br>
                                                                Mob: 8086898017</td>
                                                                </tr><tr class="row-8 even" role="row">
                                                                <td class="column-1">7</td><td class="column-2">MAVELIKKARA WORK SHOP</td><td class="column-3">Sales Head<br>
                                                                8589998106<br>
                                                                mvkrawsat@popularv.om</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                Konnayil Suvako Industrial Complex,<br>
                                                                A One Industrial Estate, Kallumel po,<br>
                                                                Kochalummoodu, Mavelikkara,<br>
                                                                Mob: 8086078800</td>
                                                                </tr><tr class="row-9 odd" role="row">
                                                                <td class="column-1">8</td><td class="column-2">PALA</td><td class="column-3">Sales Head<br>
                                                                8086072475<br>
                                                                palasat@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                Vypana building, Oorassala Junction Arunapuram , Pala<br>
                                                                Mob: 9946105640</td>
                                                                </tr><tr class="row-10 even" role="row">
                                                                <td class="column-1">9</td><td class="column-2">PANDALAM</td><td class="column-3">Sales Head<br>
                                                                8086072489<br>
                                                                pdlmsat@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                Valiyathans Tower, Near Pandalam Palace,<br>
                                                                M C Road Pandalam<br>
                                                                Mob: 8589992598</td>
                                                                </tr><tr class="row-11 odd" role="row">
                                                                <td class="column-1">10</td><td class="column-2">PATHANAMTHITTA</td><td class="column-3">Sales Head<br>
                                                                8086072484<br>
                                                                pthasat@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                Valayil Building, Near St Peters Church, <br>
                                                                Nannuvakadu Junction,<br>
                                                                Pathanamthitta<br>
                                                                Mob: 9846970260</td>
                                                                </tr><tr class="row-12 even" role="row">
                                                                <td class="column-1">11</td><td class="column-2">PATHANAMTHITTA WORK SHOP</td><td class="column-3">Sales Head<br>
                                                                8589992371<br>
                                                                ptawsat@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                Near Collectorate, Opp. Gurumandiram,<br>
                                                                Pathanamthitta<br>
                                                                Mob: 9072609502</td>
                                                                </tr><tr class="row-13 odd" role="row">
                                                                <td class="column-1">12</td><td class="column-2">RANNI</td><td class="column-3">Sales Head<br>
                                                                8943345982<br>
                                                                rannisat@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                Valiyamannil Building, Opp Indian Oil Pump,<br>
                                                                Pazhavangady, Ranni<br>
                                                                Mob: 9846435250</td>
                                                                </tr><tr class="row-14 even" role="row">
                                                                <td class="column-1">13</td><td class="column-2">THIRUVALLA</td><td class="column-3">Sales Head<br>
                                                                8086078747<br>
                                                                trvlsat@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                Oppst. Erankavu Temple <br>
                                                                Kavumbhagom, Thiruvalla<br>
                                                                Mob: 8086072450</td>
                                                                </tr><tr class="row-15 odd" role="row">
                                                                <td class="column-1">14</td><td class="column-2">THIRUVALLA&nbsp; WORK SHOP</td><td class="column-3">Sales Head<br>
                                                                8086072461<br>
                                                                ws.trvla@populaarv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                Oppst. Erankavu Temple<br>
                                                                Kavumbhagom, Thiruvalla<br>
                                                                Mob: 8086072450</td>
                                                                </tr><tr class="row-16 even" role="row">
                                                                <td class="column-1">15</td><td class="column-2">VAIKOM</td><td class="column-3">Sales Head<br>
                                                                8086078742<br>
                                                                vkmsat@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                Vaikom Kuries Building, Opp.Union Bank,<br>
                                                                Valiyakavala, Vaikom<br>
                                                                Mob: 9846895548</td>
                                                                </tr><tr class="row-17 odd" role="row">
                                                                <td class="column-1">16</td><td class="column-2">PALA WORK SHOP</td><td class="column-3">Sales Head<br>
                                                                8943345931<br>
                                                                ws.pala@popularv.com</td><td class="column-4">Popular Vehicles And Services Ltd,<br>
                                                                12th Mile, P.P.Road Pala<br>
                                                                Mob: 9072609543</td>
                                                                </tr><tr class="row-18 even" role="row">
                                                                <td class="column-1">17</td><td class="column-2">KAYAMKULAM WORK SHOP</td><td class="column-3">Sales Head<br>
                                                                8086072468<br>
                                                                ws.kyklm@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                N.H-47, Kottukulangara po,<br>
                                                                Kayamkulam<br>
                                                                Mob: 9846498659</td>
                                                                </tr></tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header" id="heading-thrichur">
                                                        <h2 class="mb-0">
                                                            <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsethrichur">
                                                            <i class="fa fa-plus"></i> E-outlets & SPCs TRICHUR</button>
                                                        </h2>
                                                    </div>
                                                    <div id="collapsethrichur" class="collapse" aria-labelledby="heading-thrichur" data-parent="#accordion-sales">
                                                        <div class="card-body">
                                                            <table id="tablepress-99" class="table table-responsive w-100">
                                                                <thead>
                                                                <tr class="row-1 odd" role="row"><th class="column-1 sorting_disabled" rowspan="1" colspan="1" style="width: 20px;">SL NO</th><th class="column-2 sorting_disabled" rowspan="1" colspan="1" style="width: 155px;">Name of SPC</th><th class="column-3 sorting_disabled" rowspan="1" colspan="1" style="width: 235px;">NAME OF SPCH</th><th class="column-4 sorting_disabled" rowspan="1" colspan="1" style="width: 265px;">ADDRESS</th></tr>
                                                                </thead>
                                                                <tbody class="row-hover">
                                                                <tr class="row-2 even" role="row">
                                                                <td class="column-1">1</td><td class="column-2">ALATHUR SPC</td><td class="column-3">Sales Head <br>
                                                                8589982337<br>
                                                                alathursat@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                WARD NO.6, BUILDING NO.53, 54<br>
                                                                SWATHI JUNCTION<br>
                                                                OPP. PUTHUKULANGARA TEMPLE<br>
                                                                ALATHUR PANCHAYATH, NH 47<br>
                                                                ALATHUR - 678541<br>
                                                                8589982337</td>
                                                                </tr><tr class="row-3 odd" role="row">
                                                                <td class="column-1">2</td><td class="column-2">CHALAKUDY SPC</td><td class="column-3">Sales Head <br>
                                                                9846348000<br>
                                                                ckysat@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                PANAMBILLY COLLEGE JUNCTION,<br>
                                                                WARD NO.9, BUILDING NO.461, B2, B3, B4<br>
                                                                CHALAKUDY MUNCIPALITY<br>
                                                                NH: POTTA-680722<br>
                                                                4802700872</td>
                                                                </tr><tr class="row-4 even" role="row">
                                                                <td class="column-1">3</td><td class="column-2">IRINJALAKUDA SPC</td><td class="column-3">Sales Head <br>
                                                                9846036505<br>
                                                                ijksat@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                WARD NO.2, BUILDING NO. 281<br>
                                                                VELLUKKARA PANCHAYATH<br>
                                                                COMBARA JUNCTION<br>
                                                                NEAR CO-OPERATIVE HOSPITAL<br>
                                                                IRINJALAKUDA-680121<br>
                                                                4802856822</td>
                                                                </tr><tr class="row-5 odd" role="row">
                                                                <td class="column-1">4</td><td class="column-2">KUNNAMKULAM SPC</td><td class="column-3">Sales Head <br>
                                                                9846063456<br>
                                                                honeykc@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                WARD NO. 15, BUILDING NO. 795 F, G, H, I<br>
                                                                KUNNAMKULAM MUNCIPALITY<br>
                                                                KANIPAYOOR (P.O)<br>
                                                                KUNNAMKULM,THRISSUR-680517<br>
                                                                9846298604</td>
                                                                </tr><tr class="row-6 even" role="row">
                                                                <td class="column-1">5</td><td class="column-2">OTTAPALAM SPC</td><td class="column-3">Sales Head <br>
                                                                8589982305<br>
                                                                otplmsat@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                WARD NO.8<br>
                                                                BUILDING NO. 42/11<br>
                                                                VANIYAMKULAM PANCHAYATH<br>
                                                                MANISEERY(P.O)<br>
                                                                OTTAPPALAM-679521<br>
                                                                8086078830</td>
                                                                </tr><tr class="row-7 odd" role="row">
                                                                <td class="column-1">6</td><td class="column-2">PALAKKAD SPC</td><td class="column-3">Sales Head <br>
                                                                8589998183<br>
                                                                pktsat@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                WARD NO.23, BUILDING NO. 18/5(4&amp;5)<br>
                                                                SURUMI PLAZA, FORT MAITHAN<br>
                                                                PALAKKAD MUNCIPALITY<br>
                                                                PALAKKAD-1<br>
                                                                8589998183</td>
                                                                </tr><tr class="row-8 even" role="row">
                                                                <td class="column-1">7</td><td class="column-2">PERINJANAM SPC</td><td class="column-3">Sales Head <br>
                                                                8086072392<br>
                                                                perinjanamsat@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                WARD NO.3, BUILDING NO.572<br>
                                                                PERINJANAM PANCHAYAT<br>
                                                                NEAR YAMUNA THEATRE<br>
                                                                NH 17<br>
                                                                PERINJANAM 680 686<br>
                                                                8589992640</td>
                                                                </tr><tr class="row-9 odd" role="row">
                                                                <td class="column-1">8</td><td class="column-2">CHAVAKKAD SPC</td><td class="column-3">Sales Head<br>
                                                                9846298616<br>
                                                                cvd.spm@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                WARD NO.1 , DOOR NO.38A<br>
                                                                SURVEY NO:32/1 &amp; 32/2, OTTATHENGU <br>
                                                                ORUMANAYUR VILLAGE, CHAVAKKAD SUB, <br>
                                                                THRISSUR DISTRICT 680512</td>
                                                                </tr></tbody>
                                                                </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header" id="heading-calicut">
                                                        <h2 class="mb-0">
                                                            <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsecalicut">
                                                            <i class="fa fa-plus"></i> E-outlets & SPCs CALICUT</button>
                                                        </h2>
                                                    </div>
                                                    <div id="collapsecalicut" class="collapse" aria-labelledby="heading-calicut" data-parent="#accordion-sales">
                                                        <div class="card-body">
                                                            <table id="tablepress-120" class="table table-responsive w-100">
                                                                <thead>
                                                                <tr class="row-1 odd" role="row"><th class="column-1 sorting" tabindex="0" aria-controls="tablepress-120" rowspan="1" colspan="1" aria-label="SL NO: activate to sort column ascending" style="width: 20px;">SL NO</th><th class="column-2 sorting" tabindex="0" aria-controls="tablepress-120" rowspan="1" colspan="1" aria-label="Name of SPC: activate to sort column ascending" style="width: 155px;">Name of SPC</th><th class="column-3 sorting" tabindex="0" aria-controls="tablepress-120" rowspan="1" colspan="1" aria-label="NAME OF SPCH: activate to sort column ascending" style="width: 235px;">NAME OF SPCH</th><th class="column-4 sorting" tabindex="0" aria-controls="tablepress-120" rowspan="1" colspan="1" aria-label="ADDRESS: activate to sort column ascending" style="width: 265px;">ADDRESS</th></tr>
                                                                </thead>
                                                                <tbody class="row-hover">
                                                                <tr class="row-2 even" role="row">
                                                                <td class="column-1">1</td><td class="column-2">ATHOLI</td><td class="column-3">BABIN T T<br>
                                                                8086072542<br>
                                                                atholisat@popularv.com</td><td class="column-4">POPULAR VEHICLES N SERVICES PVT LTD, IX/374 E,F,G ,ATHANI, ATHOLI, CALICUT 673315</td>
                                                                </tr><tr class="row-3 odd" role="row">
                                                                <td class="column-1">2</td><td class="column-2">NALLALAM</td><td class="column-3">RATHEESH N K<br>
                                                                8589998183<br>
                                                                rkrsat@popularv.com</td><td class="column-4">POPULAR VEHICLES AND SERVICE, TRUE VALUE DIVISION, MODERN BAZAR, NALLALAM, CALICUT 673018</td>
                                                                </tr><tr class="row-4 even" role="row">
                                                                <td class="column-1">3</td><td class="column-2">MUKKAM</td><td class="column-3">MUHAMMED RAOOF A P<br>
                                                                8086098906<br>
                                                                muksat@popularv.com</td><td class="column-4">NEAR BRIDGE, KARASSERY, MUKKAM, CALICUT-623602</td>
                                                                </tr><tr class="row-5 odd" role="row">
                                                                <td class="column-1">4</td><td class="column-2">THAMARASSERY</td><td class="column-3">SUMESH<br>
                                                                8086078679<br>
                                                                spchead.tsy@popularv.com</td><td class="column-4">BC TOWER, WAYANAD ROAD,KARADI, THAMARASSERY, CALICUT 673573</td>
                                                                </tr><tr class="row-6 even" role="row">
                                                                <td class="column-1">5</td><td class="column-2">PERAMBRA</td><td class="column-3">PRASEED KUMAR<br>
                                                                8589992485<br>
                                                                prmbasat@popularv.com</td><td class="column-4">NEAR LIC, KUTTIADI ROAD,KALLODE, PERAMBRA, CALICUT-673525</td>
                                                                </tr><tr class="row-7 odd" role="row">
                                                                <td class="column-1">6</td><td class="column-2">VADAKARA</td><td class="column-3">PRANEESH<br>
                                                                8086072529<br>
                                                                vdasat@popularv.com</td><td class="column-4">OPP.KRISHNAKRIPA KALYANAMANDAPAM, NEAR NEW BUSTAND, VADAKARA, CALICUT-673101</td>
                                                                </tr><tr class="row-8 even" role="row">
                                                                <td class="column-1">7</td><td class="column-2">KALLACHI</td><td class="column-3">AMEER<br>
                                                                8086072507<br>
                                                                spchkallachi@popularv.com</td><td class="column-4">P.M TOWER, NADAPURAM ROAD, KALLACHI, CALICUT 673504</td>
                                                                </tr><tr class="row-9 odd" role="row">
                                                                <td class="column-1"></td><td class="column-2">MADAPALLI</td><td class="column-3">SAJIR C H<br>
                                                                8589992487<br>
                                                                mdp.spm.head@popularv.com</td><td class="column-4">NEAR MADAPALLI GOVT COLLEGE, MADAPALLI P.O, VADAKARA,CALICUT</td>
                                                                </tr><tr class="row-10 even" role="row">
                                                                <td class="column-1">8</td><td class="column-2">KALPETTA</td><td class="column-3">REJI V T<br>
                                                                8086072532<br>
                                                                klptsat@popularv.com</td><td class="column-4">POPULAR VEHICLES &amp; SERVICES LTD,<br>
                                                                M.J BUILDING, KAINATTY JN,<br>
                                                                KALPETTA NORTH, WAYANAD-673122<br>
                                                                </td>
                                                                </tr><tr class="row-11 odd" role="row">
                                                                <td class="column-1">10</td><td class="column-2">SULTHAN BATHERY</td><td class="column-3">RAJEEVAN<br>
                                                                8086072496<br>
                                                                wyndsat@popularv.com</td><td class="column-4">AFTHAB QUARTERS, NEAR KARUNA HOSPITAL, MANIKUNI, SULTHAN BATHERY,Wayanad -673 592</td>
                                                                </tr><tr class="row-12 even" role="row">
                                                                <td class="column-1">11</td><td class="column-2">MANATHAVADI</td><td class="column-3">NISHAD K K<br>
                                                                9539009782<br>
                                                                mntdysat@popularv.com</td><td class="column-4">NEAR POLICE STATION, KOZHIKODE ROAD, MANANTHAVADY,WAYANAD-670645</td>
                                                                </tr><tr class="row-13 odd" role="row">
                                                                <td class="column-1">12</td><td class="column-2">KOTTAKAL</td><td class="column-3">NABEEL<br>
                                                                9072609660<br>
                                                                ktklsat@popularv.com</td><td class="column-4">NEAR ROYAL MARBLES,POOVACHINA,RANDATHANI,KOTTAKKAL MALAPPURAM 676510</td>
                                                                </tr><tr class="row-14 even" role="row">
                                                                <td class="column-1">13</td><td class="column-2">WANDOOR</td><td class="column-3">SHARAT<br>
                                                                9846008686<br>
                                                                wandoorsat@popularv.com<br>
                                                                </td><td class="column-4">NEAR GOVT BOYS HIGH SCHOOL GROUND, MANJERI ROAD, WANDOOR,MALAPPURAM PIN:679328</td>
                                                                </tr><tr class="row-15 odd" role="row">
                                                                <td class="column-1">14</td><td class="column-2">AREECODE</td><td class="column-3">SAJAN PHILIP<br>
                                                                8086078761<br>
                                                                acd.spm.head@popularv.com</td><td class="column-4">South Puthalam, Nilambur Road Jn. Areacode, MALAPPURAM Pin code: 673639</td>
                                                                </tr><tr class="row-16 even" role="row">
                                                                <td class="column-1">15</td><td class="column-2">NILAMBUR</td><td class="column-3">SHAIJU N<br>
                                                                8086078838<br>
                                                                nilsat@popularv.com</td><td class="column-4">OPP.LITTLE FLOWER SCHOOL,JANATHAPPADI,NILAMBUR, MALAPPURAM 679329</td>
                                                                </tr><tr class="row-17 odd" role="row">
                                                                <td class="column-1">16</td><td class="column-2">KONDOTTY</td><td class="column-3">MISBAH<br>
                                                                8086078677<br>
                                                                kondottysat@popularv.com<br>
                                                                </td><td class="column-4">NEAR HP PETROL PUMB, AIRPORT JUNCTION, KOLATHUR, THURAKKAL P O, KONDOTTY, MALAPPURAM 673638</td>
                                                                </tr><tr class="row-18 even" role="row">
                                                                <td class="column-1">17</td><td class="column-2">MANJERI</td><td class="column-3">JITHESH<br>
                                                                9539007164<br>
                                                                jithesh@popularv.com</td><td class="column-4">THURAKKAL BYE PASS JUNCTION,CALICUT ROAD,MANJERI, MALAPPURAM 676121</td>
                                                                </tr><tr class="row-19 odd" role="row">
                                                                <td class="column-1">18</td><td class="column-2">PERINTHALMANNA</td><td class="column-3">SURESH K S<br>
                                                                8086072530<br>
                                                                spchpmna@popularv.com</td><td class="column-4">NEAR GOVT.HOSPITAL,MANNARKKAD ROAD,PERINTHALMANNA, MALAPPURAM 679322</td>
                                                                </tr><tr class="row-20 even" role="row">
                                                                <td class="column-1">19</td><td class="column-2">EDAVANNAPARA</td><td class="column-3">RAJEEV P T<br>
                                                                8943345880<br>
                                                                evp.spm.head@popularv.com<br>
                                                                </td><td class="column-4">OPP.VATTAPARA TRADING CORPORATION, KONDOTTY ROAD, EDAVANNAPARA, MALAPPURAM-673645</td>
                                                                </tr></tbody>
                                                                </table>
                                                                <thead>
                                                                <tr class="row-1 odd" role="row"><th class="column-1 sorting_disabled" rowspan="1" colspan="1" style="width: 20px;">SL NO</th><th class="column-2 sorting_disabled" rowspan="1" colspan="1" style="width: 155px;">Name of SPC</th><th class="column-3 sorting_disabled" rowspan="1" colspan="1" style="width: 235px;">NAME OF SPCH</th><th class="column-4 sorting_disabled" rowspan="1" colspan="1" style="width: 265px;">ADDRESS</th></tr>
                                                                </thead>
                                                                <tbody class="row-hover">
                                                                <tr class="row-2 even" role="row">
                                                                <td class="column-1">1</td><td class="column-2">ALATHUR SPC</td><td class="column-3">Sales Head <br>
                                                                8589982337<br>
                                                                alathursat@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                WARD NO.6, BUILDING NO.53, 54<br>
                                                                SWATHI JUNCTION<br>
                                                                OPP. PUTHUKULANGARA TEMPLE<br>
                                                                ALATHUR PANCHAYATH, NH 47<br>
                                                                ALATHUR - 678541<br>
                                                                8589982337</td>
                                                                </tr><tr class="row-3 odd" role="row">
                                                                <td class="column-1">2</td><td class="column-2">CHALAKUDY SPC</td><td class="column-3">Sales Head <br>
                                                                9846348000<br>
                                                                ckysat@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                PANAMBILLY COLLEGE JUNCTION,<br>
                                                                WARD NO.9, BUILDING NO.461, B2, B3, B4<br>
                                                                CHALAKUDY MUNCIPALITY<br>
                                                                NH: POTTA-680722<br>
                                                                4802700872</td>
                                                                </tr><tr class="row-4 even" role="row">
                                                                <td class="column-1">3</td><td class="column-2">IRINJALAKUDA SPC</td><td class="column-3">Sales Head <br>
                                                                9846036505<br>
                                                                ijksat@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                WARD NO.2, BUILDING NO. 281<br>
                                                                VELLUKKARA PANCHAYATH<br>
                                                                COMBARA JUNCTION<br>
                                                                NEAR CO-OPERATIVE HOSPITAL<br>
                                                                IRINJALAKUDA-680121<br>
                                                                4802856822</td>
                                                                </tr><tr class="row-5 odd" role="row">
                                                                <td class="column-1">4</td><td class="column-2">KUNNAMKULAM SPC</td><td class="column-3">Sales Head <br>
                                                                9846063456<br>
                                                                honeykc@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                WARD NO. 15, BUILDING NO. 795 F, G, H, I<br>
                                                                KUNNAMKULAM MUNCIPALITY<br>
                                                                KANIPAYOOR (P.O)<br>
                                                                KUNNAMKULM,THRISSUR-680517<br>
                                                                9846298604</td>
                                                                </tr><tr class="row-6 even" role="row">
                                                                <td class="column-1">5</td><td class="column-2">OTTAPALAM SPC</td><td class="column-3">Sales Head <br>
                                                                8589982305<br>
                                                                otplmsat@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                WARD NO.8<br>
                                                                BUILDING NO. 42/11<br>
                                                                VANIYAMKULAM PANCHAYATH<br>
                                                                MANISEERY(P.O)<br>
                                                                OTTAPPALAM-679521<br>
                                                                8086078830</td>
                                                                </tr><tr class="row-7 odd" role="row">
                                                                <td class="column-1">6</td><td class="column-2">PALAKKAD SPC</td><td class="column-3">Sales Head <br>
                                                                8589998183<br>
                                                                pktsat@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                WARD NO.23, BUILDING NO. 18/5(4&amp;5)<br>
                                                                SURUMI PLAZA, FORT MAITHAN<br>
                                                                PALAKKAD MUNCIPALITY<br>
                                                                PALAKKAD-1<br>
                                                                8589998183</td>
                                                                </tr><tr class="row-8 even" role="row">
                                                                <td class="column-1">7</td><td class="column-2">PERINJANAM SPC</td><td class="column-3">Sales Head <br>
                                                                8086072392<br>
                                                                perinjanamsat@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                WARD NO.3, BUILDING NO.572<br>
                                                                PERINJANAM PANCHAYAT<br>
                                                                NEAR YAMUNA THEATRE<br>
                                                                NH 17<br>
                                                                PERINJANAM 680 686<br>
                                                                8589992640</td>
                                                                </tr><tr class="row-9 odd" role="row">
                                                                <td class="column-1">8</td><td class="column-2">CHAVAKKAD SPC</td><td class="column-3">Sales Head<br>
                                                                9846298616<br>
                                                                cvd.spm@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                WARD NO.1 , DOOR NO.38A<br>
                                                                SURVEY NO:32/1 &amp; 32/2, OTTATHENGU <br>
                                                                ORUMANAYUR VILLAGE, CHAVAKKAD SUB, <br>
                                                                THRISSUR DISTRICT 680512</td>
                                                                </tr></tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header" id="heading-kannur">
                                                        <h2 class="mb-0">
                                                            <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsekannur">
                                                            <i class="fa fa-plus"></i> E-outlets & SPCs KANNUR</button>
                                                        </h2>
                                                    </div>
                                                    <div id="collapsekannur" class="collapse" aria-labelledby="heading-kannur" data-parent="#accordion-sales">
                                                        <div class="card-body">
                                                            <table id="tablepress-116" class="table table-responsive w-100">
                                                                <thead>
                                                                <tr class="row-1 odd">
                                                                <th class="column-1">SL NO</th><th class="column-2">Name of SPC</th><th class="column-3">NAME OF SPCH</th><th class="column-4">ADDRESS</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody class="row-hover">
                                                                <tr class="row-2 even">
                                                                <td class="column-1">1</td><td class="column-2">KANHANGAD</td><td class="column-3">Sales Head<br>
                                                                8086072511<br>
                                                                moideen@popularv.com</td><td class="column-4">POPULAR VEHICLES &amp; SERVICES LTD, HIGHWAY JUNCTION, KANHAHGAD SOUTH P.O,KANHANGHAD, PIN-671315</td>
                                                                </tr>
                                                                <tr class="row-3 odd">
                                                                <td class="column-1">2</td><td class="column-2">CHEMMANAD</td><td class="column-3">Sales Head<br>
                                                                9539009778<br>
                                                                ksrgodsat@popularv.com</td><td class="column-4">POPULAR VEHICLES &amp; SERVICES LTD,MUNDAMKULAM ,CHEMMANAD, KASARAGODE</td>
                                                                </tr>
                                                                <tr class="row-4 even">
                                                                <td class="column-1">3</td><td class="column-2">UPPALA</td><td class="column-3">Sales Head<br>
                                                                8086078762<br>
                                                                uplaesat@popularv.com</td><td class="column-4">POPULAR VEHICLES &amp; SERVICES LTD, N.H.17,NATTAKKAL COMPLEX, KAIKAMBA, UPPALA.P.O, KASARAGODE 671322</td>
                                                                </tr>
                                                                <tr class="row-5 odd">
                                                                <td class="column-1">4</td><td class="column-2">THRIKKARIPUR</td><td class="column-3">Sales Head<br>
                                                                8589992670<br>
                                                                tkr.spm@popularv.com</td><td class="column-4">POPULAR VEHICLES &amp; SERVICES LTD, NEAR TRIKARIPUR FARMERS SERVICE CO OP BANK.PAYYANNUR ROAD, TRIKARIPUR, KASARAGOD DIST</td>
                                                                </tr>
                                                                <tr class="row-6 even">
                                                                <td class="column-1">5</td><td class="column-2">KANNUR</td><td class="column-3">Sales Head<br>
                                                                8086072517<br>
                                                                spchknr@popularv.com</td><td class="column-4">POPULAR VEHICLES &amp; SERVICES LTD, OPP SREEPURAM SCHOOL, PALLIKKUNNU, KANNUR-670004</td>
                                                                </tr>
                                                                <tr class="row-7 odd">
                                                                <td class="column-1">6</td><td class="column-2">THALIPARAMABA</td><td class="column-3">Sales Head<br>
                                                                8086072513<br>
                                                                knr.spm.head2@popularv.com</td><td class="column-4">POPULAR VEHICLES &amp; SERVICES LTD, P.R COMPLEX, KUTTIKOL, THALIPARAMBA</td>
                                                                </tr>
                                                                <tr class="row-8 even">
                                                                <td class="column-1">7</td><td class="column-2">PAYYANNUR</td><td class="column-3">Sales Head<br>
                                                                9539009780<br>
                                                                pyrsat@popularv.com</td><td class="column-4">POPULAR VEHICLES &amp; SERVICES LTD, H.B ARCADE BUILDING, GOVT HOSPITAL ROAD,LIC JUNCTION, PAYYANUR-670307</td>
                                                                </tr>
                                                                <tr class="row-9 odd">
                                                                <td class="column-1">8</td><td class="column-2">IRITTY</td><td class="column-3">Sales Head<br>
                                                                8589998142<br>
                                                                iritty.spm.head@popularv.com</td><td class="column-4">POPULAR VEHICLES &amp; SERVICES LTD, KEEZHOOR, OPP.ESSAR PETROL PUMP,IRITTY,KANNUR- 670703</td>
                                                                </tr>
                                                                <tr class="row-10 even">
                                                                <td class="column-1">9</td><td class="column-2">SREEKANDAPURAM</td><td class="column-3">Sales Head<br>
                                                                8589992650<br>
                                                                skp.spm@popularv.com</td><td class="column-4">POPULAR VEHICLES &amp; SERVICES LTD,KOTTURVAYAL, SREEKANDAPURAM P O, KANNUR 670631</td>
                                                                </tr>
                                                                <tr class="row-11 odd">
                                                                <td class="column-1">10</td><td class="column-2">ALAKKODE</td><td class="column-3">Sales Head<br>
                                                                9207986486<br>
                                                                akd.spm@popularv.com</td><td class="column-4">POPULAR VEHICLES &amp; SERVICES LTD, KUNNATHOT BUILDING, NEAR PETROL PUMB, ALAKODE</td>
                                                                </tr>
                                                                <tr class="row-12 even">
                                                                <td class="column-1">11</td><td class="column-2">PANOOR</td><td class="column-3">Sales Head<br>
                                                                8086072515<br>
                                                                spchpnr@popularv.com</td><td class="column-4">POPULAR VEHICLES &amp; SERVICES LTD,K.C TOWER, OPP.WEST UP SCHOOL, PANOOR-670692</td>
                                                                </tr>
                                                                <tr class="row-13 odd">
                                                                <td class="column-1">12</td><td class="column-2">KOOTHUPRAMBA</td><td class="column-3">Sales Head<br>
                                                                8943345821<br>
                                                                ktba.spm.head@popularv.com</td><td class="column-4">POPULAR VEHICLES &amp; SERVICES LTD, CITY ARCADE, STADIUM ROAD,KUTHUPARAMBA KANNUR 670643</td>
                                                                </tr>
                                                                <tr class="row-14 even">
                                                                <td class="column-1">13</td><td class="column-2">MATTANUR</td><td class="column-3">Sales Head<br>
                                                                9072609575<br>
                                                                spchmtnr@popularv.com</td><td class="column-4">POPULAR VEHICLES &amp; SERVICES LTD, ARYA BUILDING, NEAR KOTHERI JUMA MASJID, KANNUR ROAD, KOTHERI, MATTANNUR, KANNUR 670702</td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="tab-pane fade" id="nav-service" role="tabpanel" aria-labelledby="nav-service-tab">

                                        <div class="bs-services">
                                            <div class="accordion" id="accordion-services">
                                                <div class="card">
                                                    <div class="card-header" id="heading-showroom">
                                                        <h2 class="mb-0">
                                                            <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne">
                                                            <i class="fa fa-plus"></i> SERVICE CENTRES</button>
                                                        </h2>
                                                    </div>
                                                    <div id="collapseOne" class="collapse show" aria-labelledby="heading-showroom" data-parent="#accordion-services">
                                                        <div class="card-body">
                                                            <table id="tablepress-7" class="table" role="grid">
                                                                <thead>
                                                                <tr class="row-1 odd" role="row"><th class="column-1 sorting_disabled" rowspan="1" colspan="1" style="width: 20px;">&nbsp;</th><th class="column-2 sorting_disabled" rowspan="1" colspan="1" style="width: 155px;">Branches</th><th class="column-3 sorting_disabled" rowspan="1" colspan="1" style="width: 235px;">Branch heads<br>
                                                                </th><th class="column-4 sorting_disabled" rowspan="1" colspan="1" style="width: 265px;">Branch Address<br>
                                                                </th></tr>
                                                                </thead>
                                                                <tbody class="row-hover">
                                                                <tr class="row-2 even" role="row">
                                                                <td class="column-1"></td><td class="column-2">Chennai Cluster<br>
                                                                </td><td class="column-3">Johny N V<br>
                                                                Regional Manager<br>
                                                                98461 61601<br>
                                                                johny@popularv.com</td><td class="column-4"></td>
                                                                </tr><tr class="row-3 odd" role="row">
                                                                <td class="column-1"></td><td class="column-2">Cochin/Kochi Cluster<br>
                                                                </td><td class="column-3">Johny N V<br>
                                                                Regional Manager<br>
                                                                98461 61601<br>
                                                                johny@popularv.com</td><td class="column-4"></td>
                                                                </tr><tr class="row-4 even" role="row">
                                                                <td class="column-1"></td><td class="column-2">Thrissur Cluster<br>
                                                                </td><td class="column-3">Johny N V<br>
                                                                Regional Manager<br>
                                                                98461 61601<br>
                                                                johny@popularv.com</td><td class="column-4"></td>
                                                                </tr><tr class="row-5 odd" role="row">
                                                                <td class="column-1"></td><td class="column-2">Trivandrum cluster<br>
                                                                </td><td class="column-3">Nisha A S<br>
                                                                Regional Manager<br>
                                                                98460 36696<br>
                                                                nisha@popularv.com</td><td class="column-4"></td>
                                                                </tr><tr class="row-6 even" role="row">
                                                                <td class="column-1"></td><td class="column-2">Calicut Cluster</td><td class="column-3">Shajikumar A P<br>
                                                                Regional Manager<br>
                                                                9846400300<br>
                                                                rm.clt@popularv.com</td><td class="column-4"></td>
                                                                </tr><tr class="row-7 odd" role="row">
                                                                <td class="column-1"></td><td class="column-2">Kollam Cluster</td><td class="column-3">Sankar Babu G S<br>
                                                                Regional Manager<br>
                                                                9072609555<br>
                                                                klm.srm.rm@popularv.com</td><td class="column-4"></td>
                                                                </tr><tr class="row-8 even" role="row">
                                                                <td class="column-1"></td><td class="column-2">Kannur Cluster</td><td class="column-3">PREMLAL M P<br>
                                                                DEPUTY REGIONAL MANAGER<br>
                                                                9846298609<br>
                                                                knr.srm.rm@popularv.com</td><td class="column-4"></td>
                                                                </tr><tr class="row-9 odd" role="row">
                                                                <td class="column-1"></td><td class="column-2">Kottayam Cluster</td><td class="column-3">Siby Mathew Jose<br>
                                                                Regional Manager<br>
                                                                9946105687<br>
                                                                sibimathew@popularv.com</td><td class="column-4"></td>
                                                                </tr><tr class="row-10 even" role="row">
                                                                <td class="column-1">1</td><td class="column-2">Angamaly Service<br>
                                                                <a href="https://www.google.com/maps/place/Popular+Vehicles+and+Services+ltd,+182+Airport+Junction+nagar/@10.184805,76.400915,18z/data=!4m2!3m1!1s0x0:0x4489186adac13d2a?hl=en-US" target="_blank" rel="noopener">View Map</a></td><td class="column-3">Manager-Service<br>
                                                                8086078866<br>
                                                                wmangamaly@popularv.com<br>
                                                                </td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                182 Airport Junction nagar<br>
                                                                M C Road<br>
                                                                Angamaly P O<br>
                                                                Pin-683572<br>
                                                                Ph No - 0484 245 3813,0484 245 3913<br>
                                                                Break Down Service : 808 607 2376</td>
                                                                </tr><tr class="row-11 odd" role="row">
                                                                <td class="column-1">2</td><td class="column-2">Attingal Service<br>
                                                                <a href="https://goo.gl/maps/FGvjEZnBsbvMVTuB9" target="_blank" rel="noopener">View Map</a></td><td class="column-3">Manager-Service<br>
                                                                8086078788<br>
                                                                wm.attingal@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                Pallamkonam, Thoppichanta<br>
                                                                Perumkulam.P.o<br>
                                                                Alamcode<br>
                                                                Attingal-695102,Trivandrum<br>
                                                                Ph : 0470-2689915<br>
                                                                Break Down Service: 974 592 7555</td>
                                                                </tr><tr class="row-12 even" role="row">
                                                                <td class="column-1">3</td><td class="column-2">Balaramapuram service<br>
                                                                <a href="https://www.google.com/maps/place/Popular+vehicles+%26+Services+Ltd,+Poovar+Road,+Vazhimukku,+Balaramapuram+P+O/@8.414998,77.051291,15z/data=!4m2!3m1!1s0x0:0x154c96a2b5f8b9d3?hl=en-US" target="_blank" rel="noopener">View Map</a><br>
                                                                </td><td class="column-3">Manager-Service<br>
                                                                8943345922<br>
                                                                wm.blr@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                Poovar Road, Vazhimukku, Balaramapuram P O,<br>
                                                                Balaramapuram, Trivandrum-695501<br>
                                                                Ph : 0471 - 278 1017, 0471 - 278 1016<br>
                                                                Break Down Service : 894 334 5978</td>
                                                                </tr><tr class="row-13 odd" role="row">
                                                                <td class="column-1">4</td><td class="column-2">Calicut service<br>
                                                                <a href="https://www.google.com/maps/place/Popular+Vehicles+%26+Services+Ltd,+Behind+MIMS,+Off+Mini+Bye+Pass/@11.244906,75.796197,0z/data=!4m2!3m1!1s0x0:0x65271022a18db11a?hl=en-US" target="_blank" rel="noopener">View Map</a></td><td class="column-3">Works Manager<br>
                                                                8086078650<br>
                                                                wm.clt@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                Behind MIMS, Off  Mini Bye Pass,<br>
                                                                Easwaramangalam Road,<br>
                                                                Govindapuram P.O.,  <br>
                                                                Kozhikode – 673 016<br>
                                                                Ph. No. 984 649 8631, 953 900 7377<br>
                                                                Break Down Service : 984 606 1188</td>
                                                                </tr><tr class="row-14 even" role="row">
                                                                <td class="column-1">5</td><td class="column-2">Chalakudy Service<br>
                                                                <a href="https://www.google.com/maps/place/Popular+Vehicles+%26+Services+Ltd,+Opp+CCMK+Hospital,+Vellikulam+Road/@10.313971,76.336644,16z/data=!4m2!3m1!1s0x0:0xc035027348430a67?hl=en-US" target="_blank" rel="noopener">View Map</a></td><td class="column-3">Manager-Service<br>
                                                                907 260 9600<br>
                                                                cky.srm.wm@popularv.com<br>
                                                                </td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                Opp CCMK Hospital,<br>
                                                                Vellikulam Road,<br>
                                                                Chalakudy, PIN 680307.<br>
                                                                Ph No.  994 610 4654,0480 270 0568<br>
                                                                Break Down Service : 984 696 1119</td>
                                                                </tr><tr class="row-15 odd" role="row">
                                                                <td class="column-1">6</td><td class="column-2">Chennai Service<br>
                                                                <a href="https://www.google.com/maps/place/Popular+Vehicles+And+Services+Ltd./@13.049067,80.203944,20z/data=!4m2!3m1!1s0x0:0x4e8218060665647e?hl=en-US" target="_blank" rel="noopener">View Map</a><br>
                                                                </td><td class="column-3">Manager-Service<br>
                                                                9962482752<br>
                                                                wm.saligramam@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                No. 14,  Arunachalam Road, <br>
                                                                Saligramam, Chennai 600 094<br>
                                                                Ph. No. 044 - 6587 7973<br>
                                                                Break Down Service :&nbsp;928 211 5566</td>
                                                                </tr><tr class="row-16 even" role="row">
                                                                <td class="column-1">7</td><td class="column-2">Cherthala<br>
                                                                <a href="https://www.google.com/maps/place/MARUTHI+SERVICE+CENTRE/@9.6471794,76.3343828,17z/data=!3m1!4b1!4m5!3m4!1s0x0:0x7a4cfc8b4eb12f37!8m2!3d9.6471794!4d76.3365715?hl=en">View Map</a></td><td class="column-3">Manager-Service<br>
                                                                9072530127<br>
                                                                ctl.srm.wm@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                Survey No. 150/2-,147/3,<br>
                                                                Building No.  KP-18/80<br>
                                                                N.H. Kanjikuzhi Village<br>
                                                                Cherthala, Alappuzha Dist<br>
                                                                Pin. 688 582<br>
                                                                0478 2828989<br>
                                                                9072846666<br>
                                                                Break Down Service : 9072846666</td>
                                                                </tr><tr class="row-17 odd" role="row">
                                                                <td class="column-1">8</td><td class="column-2">Elamakkara Service<br>
                                                                <a href="https://www.google.com/maps/place/Popular+Vehicles+%26+Services+Ltd,+Perandoor+Road,+Punnakal,+Elamakkara/@10.021115,76.295049,18z/data=!4m2!3m1!1s0x0:0xde3c1bed7b5f3239?hl=en-US" target="_blank" rel="noopener">View Map</a></td><td class="column-3">Manager-Service<br>
                                                                9846017725<br>
                                                                wm.elamakkara@popularv.com<br>
                                                                antony.tl@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                Perandoor Rd, Punnackal<br>
                                                                Elamakkara, Cochin/Kochi – 26<br>
                                                                Ph No. 0484 6694 444, 6694 4491, 984 622 0893<br>
                                                                Break Down Service : 984 607 6177</td>
                                                                </tr><tr class="row-18 even" role="row">
                                                                <td class="column-1">9</td><td class="column-2">Edappal Service<br>
                                                                <a href="https://www.google.co.in/maps/place/Popular+Maruti+Suzuki/@10.7995522,76.0080471,21z/data=!4m5!3m4!1s0x0:0xbd2a454f9d9d1ac8!8m2!3d10.7994773!4d76.0080793" target="_blank">View Map</a><br>
                                                                </td><td class="column-3">Manager-Service<br>
                                                                9946105691<br>
                                                                wm.edappal@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                Near K S E B Sub Station<br>
                                                                P.O Kalady<br>
                                                                Edappal, Malapuram-679582<br>
                                                                Ph No. 994 610 4679<br>
                                                                Break Down Service : 994 610 5646</td>
                                                                </tr><tr class="row-19 odd" role="row">
                                                                <td class="column-1">10</td><td class="column-2">Kanhangad service<br>
                                                                <a href="https://www.google.com/maps/place/Popular+Vehicles+and+Services+Ltd,+Highway+junction,/@12.295533,75.102909,0z/data=!4m2!3m1!1s0x0:0x4500a1c40c8ad754?hl=en-US" target="_blank" rel="noopener">View Map</a><br>
                                                                </td><td class="column-3">Manager-Service<br>
                                                                9946104685<br>
                                                                wm.kanhangad@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                Highway junction,<br>
                                                                Kanhangad South P O<br>
                                                                Kasargod Pin -671 315<br>
                                                                Ph No - 0467-220 8622,  0467 22 09417 , 994 610 4687<br>
                                                                Break Down Service : 974 500 0789</td>
                                                                </tr><tr class="row-20 even" role="row">
                                                                <td class="column-1">11</td><td class="column-2">Kasargode Service<br>
                                                                <a href="https://www.google.com/maps/place/Popular+Vehicles+and+Services+Ltd,+Mundakulam/@12.493643,75.001826,0z/data=!4m2!3m1!1s0x0:0x235500fb1dab841f?hl=en-US" target="_blank" rel="noopener">View Map</a></td><td class="column-3">Manager-Service<br>
                                                                9946104621<br>
                                                                wm.kasargode@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                Mundakulam<br>
                                                                Chemmanad<br>
                                                                Kasaragod-671 317<br>
                                                                Ph No- 894 334 5883, 894 330 0000<br>
                                                                Break Down Service : 994 682 4442</td>
                                                                </tr><tr class="row-21 odd" role="row">
                                                                <td class="column-1">12</td><td class="column-2">Kannur Service<br>
                                                                <a href="https://www.google.com/maps/place/Popular+vehicles+%26+Services+Ltd,+Near+Elayavoor+Village+Office,+Mundayad+Road,+NS+Compound/@11.868837,75.410628,0z/data=!4m2!3m1!1s0x0:0x9bc655628001b4a9?hl=en-US" target="_blank" rel="noopener">View Map</a></td><td class="column-3">Manager-Service<br>
                                                                9846062796<br>
                                                                wm.kannur@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                Kappad Road<br>
                                                                Near Charappuram Muthappan Kavu<br>
                                                                Thazhe Chovva P.O, Kannur. 670 018<br>
                                                                Ph No. 808 609 8900, 949 596 9376<br>
                                                                Break Down Service : 984 606 0901</td>
                                                                </tr><tr class="row-22 even" role="row">
                                                                <td class="column-1">13</td><td class="column-2">Kattapana Service</td><td class="column-3">Manager-Service<br>
                                                                9946104660<br>
                                                                ktp.srm.wm@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services  Ltd<br>
                                                                Kattapana Kunthalampara Road<br>
                                                                Kattapana P.O<br>
                                                                Pin- 685 515</td>
                                                                </tr><tr class="row-23 odd" role="row">
                                                                <td class="column-1">14</td><td class="column-2">Kayamkulam service<br>
                                                                <a href="https://www.google.com/maps/place/Popular+Vehicles+%26+Services+Ltd,+Kottukulangara/@9.186963,76.488299,0z/data=!4m2!3m1!1s0x0:0xa4c137337126445b?hl=en-US" target="_blank" rel="noopener">View Map</a><br>
                                                                </td><td class="column-3">Manager-Service<br>
                                                                9946105601<br>
                                                                wm.kayamkulam@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                N.H. Kottukulangara<br>
                                                                Kayamkulam - 690 502<br>
                                                                Ph No. 894 334 5801, 994 610 5675<br>
                                                                Break Down Service : 994 610 5677</td>
                                                                </tr><tr class="row-24 even" role="row">
                                                                <td class="column-1">15</td><td class="column-2">Keelkatalai service<br>
                                                                <a href="https://www.google.com/maps/place/Popular+Motors+Maruti+Service+Station,+Old+No+155,+New+No+123,+Ponranjitham+Complex/@12.957852,80.186124,0z/data=!4m2!3m1!1s0x0:0x6a9e926cd9eed654?hl=en-US" target="_blank" rel="noopener">View Map</a></td><td class="column-3">Manager-Service<br>
                                                                9176906333<br>
                                                                wm_chennaiklk@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                Old No 155, New No 123,<br>
                                                                Ponranjitham Complex<br>
                                                                Medavakkam Main Road<br>
                                                                Keelkattalai, Chennai-600117<br>
                                                                Service Appointments &amp; Query : 917 690 6334 / 35 / 36<br>
                                                                Body Work Appointments &amp; Query : 917 690 6351 / 9282100106<br>
                                                                Maruti Insurance Renewal : 917 690 6355<br>
                                                                Break Down Service : 917 692 5566</td>
                                                                </tr><tr class="row-25 odd" role="row">
                                                                <td class="column-1">16</td><td class="column-2">Kollam Service<br>
                                                                <a href="https://www.google.com/maps/place/Popular+Vehicles+and+Service/@8.8728837,76.598173,18.04z/data=!4m8!1m2!2m1!1sPopular+Vehicles+%26+Services,Mundakkal,+Kollam,+Kerala+691001!3m4!1s0x0:0x4e958ea7dcf06356!8m2!3d8.872886!4d76.5985022?hl=en-US" target="_blank" rel="noopener">View Map</a></td><td class="column-3">Manager-Service<br>
                                                                9946105649<br>
                                                                klm.srm.wm@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                H &amp; C Compound<br>
                                                                Mundakkal West, Kollam -6910 06<br>
                                                                Ph No. (0474) 2742626, 2742636,6624454<br>
                                                                Break Down Service : 9846060905<br>
                                                                </td>
                                                                </tr><tr class="row-26 even" role="row">
                                                                <td class="column-1">17</td><td class="column-2">Kottarakara Service<br>
                                                                <a href="https://www.google.com/maps/place/Popular+Vehicles+and+Services,+Bldg+no-MPV+19A,+Govindamangalam+Road/@9.010365,76.784956,0z/data=!4m2!3m1!1s0x0:0x467e9f8808fa19aa?hl=en-US" target="_blank" rel="noopener">View Map</a></td><td class="column-3">Manager-Service<br>
                                                                80860 73466<br>
                                                                wm.kottarakkara@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                Bldg no-MPV 19A<br>
                                                                Govindamangalam Road<br>
                                                                Pulaman Junction<br>
                                                                Kottarakkara- 691 531, Kollam<br>
                                                                Ph No - 0474 662 5000, 0474 662 5002<br>
                                                                Break Down Service : 808 607 3473<br>
                                                                </td>
                                                                </tr><tr class="row-27 odd" role="row">
                                                                <td class="column-1">18</td><td class="column-2">Kottakal Service<br>
                                                                <a href="https://www.google.com/maps/place/Popular+vehicles+and+services+Ltd,+Poovanchina,+Randathani,+Kottakal/@10.953346,76.006862,0z/data=!4m2!3m1!1s0x0:0xc2788499e691e70f?hl=en-US" target="_blank" rel="noopener">View Map</a><br>
                                                                </td><td class="column-3">Manager-Service<br>
                                                                99461 04631<br>
                                                                wm.kottackal@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                Poovanchina, Randathani<br>
                                                                Kottakal Pin-676510<br>
                                                                Malappuram Dt<br>
                                                                Ph No. 953 900 7384, 953 900 7386<br>
                                                                Break Down Service : 994 610 4630</td>
                                                                </tr><tr class="row-28 even" role="row">
                                                                <td class="column-1">19</td><td class="column-2">Kothamangalam service<br>
                                                                <a href="https://www.google.com/maps/place/Popular+vehicles+and+Services+ltd,+Near+Telephone+Exchange/@10.06995,76.612102,18z/data=!4m2!3m1!1s0x0:0xa569b04fc5249133?hl=en-US" target="_blank" rel="noopener">View Map</a></td><td class="column-3">Manager-Service<br>
                                                                98460 27990<br>
                                                                wm.kothamangalam@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                Near Telephone Exchange<br>
                                                                Thankalam<br>
                                                                Kothamagalam -686691<br>
                                                                Ph No 0485 282 6880,282 6990, 808 607 8778<br>
                                                                Break Down Service : 994 610 4664</td>
                                                                </tr><tr class="row-29 odd" role="row">
                                                                <td class="column-1">20</td><td class="column-2">Kottayam service<br>
                                                                <a href="https://www.google.co.in/maps/dir/''/popular+maruti+kottayam/@9.6093027,76.5329305,19.5z/data=!4m8!4m7!1m0!1m5!1m1!1s0x3b062b6914e257fb:0xdc116e203642a4f!2m2!1d76.533051!2d9.60907" target="_blank" rel="noopener">View Map</a></td><td class="column-3">Manager-Service<br>
                                                                808 607 3454<br>
                                                                ktm.srm.wm@popularv.com<br>
                                                                Break Down – 984 606 0904</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                Near St Thomas Orthdox Church<br>
                                                                S H Mount P.O.<br>
                                                                Chavittuvary, Kottayam - 06<br>
                                                                Ph No - 0481 661 4611, 0481 661 4612<br>
                                                                Break Down Service – 984 606 0904</td>
                                                                </tr><tr class="row-30 even" role="row">
                                                                <td class="column-1">21</td><td class="column-2">Kunnamkulam Service<br>
                                                                <a href="https://www.google.com/maps/place/Popular+Vehicles+%26+Services+Ltd,+Thrissur+Road,+Choondal+P.O,+Kunnamkulam/@10.625439,76.100664,0z/data=!4m2!3m1!1s0x0:0x9ffc6d15d52cd0d0?hl=en-US" target="_blank" rel="noopener">View Map</a><br>
                                                                <br>
                                                                </td><td class="column-3">Manager-Service<br>
                                                                994 610 5695<br>
                                                                wm.kunnamkulam@popularv.com<br>
                                                                </td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                Thrissur Road, Choondal P.O.,<br>
                                                                Kunnamkulam-680 502<br>
                                                                Ph No - 994 610 5694 , 984 639 7066<br>
                                                                Break Down Service : 984 676 1119</td>
                                                                </tr><tr class="row-31 odd" role="row">
                                                                <td class="column-1">22</td><td class="column-2">Malaparamba Service<br>
                                                                <a href="https://www.google.com/maps/place/Popular+Vehicles+and+Services+ltd,+byepasss,+Pachakkil,+Malaparamba+P+O/@11.280987,75.803316,18z/data=!4m2!3m1!1s0x0:0x8923b97fb6f2330f?hl=en-US" target="_blank" rel="noopener">View Map</a></td><td class="column-3">Manager-Service<br>
                                                                9846397060<br>
                                                                wm.malaparamba@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                NH-17, byepasss, Pachakkil<br>
                                                                Malaparamba P O<br>
                                                                Calicut-673009<br>
                                                                Ph No - 858 999 2577, 808 607 8720<br>
                                                                Break Down Service : 808 607 8652</td>
                                                                </tr><tr class="row-32 even" role="row">
                                                                <td class="column-1">23</td><td class="column-2">Manjeri Service<br>
                                                                <a href="https://www.google.com/maps/place/Popular+Vehicles+and+Services,+Rajeev+Gandhi/@11.121215,76.108704,0z/data=!4m2!3m1!1s0x0:0x3527d957171c7e06?hl=en-US" target="_blank" rel="noopener">View Map</a></td><td class="column-3">Manager-Service<br>
                                                                8589992406<br>
                                                                wm.manjeri@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                Rajeev Gandhi <br>
                                                                Bypass Junction<br>
                                                                Thurakkal<br>
                                                                Manjeri-676123<br>
                                                                Ph No - 858 999 2405 ,858 999 2408<br>
                                                                Break Down Service : 8589992410</td>
                                                                </tr><tr class="row-33 odd" role="row">
                                                                <td class="column-1">24</td><td class="column-2">Mannanthala Service</td><td class="column-3">Manager-Service<br>
                                                                9846498605<br>
                                                                mnm.srm.wm@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services  Ltd<br>
                                                                Near &nbsp;Suryaprabha Auditorium<br>
                                                                Mannanthala<br>
                                                                Trivandrum-695 015</td>
                                                                </tr><tr class="row-34 even" role="row">
                                                                <td class="column-1">25</td><td class="column-2">Mavelikkara Service<br>
                                                                <a href="https://www.google.com/maps/place/Popular+Vehicles+%26+Services+Ltd,+Konnayil+Suvako+Industries+Complex,+Industrial+Estate/@9.245654,76.585181,15z/data=!4m2!3m1!1s0x0:0xa78176f460e0150d?hl=en-US" target="_blank" rel="noopener">View Map</a></td><td class="column-3">Manager-Service<br>
                                                                9846298622<br>
                                                                wm.mvk@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                Konnayil Suvako Industries Complex<br>
                                                                Industrial Estate, Kochalummoodu<br>
                                                                Kallimel P.O., Mavelikkara<br>
                                                                Ph No - 0479 2356340, 0479 235 6330<br>
                                                                Break Down Service : 994 610 5666</td>
                                                                </tr><tr class="row-35 odd" role="row">
                                                                <td class="column-1">26</td><td class="column-2">Muvattupuzha Service<br>
                                                                <a href="https://www.google.com/maps/place/Popular+vehicles+and+services+ltd,+Arakkuzha+Road,+Perumpalloor+PO/@9.959042,76.590344,18z/data=!4m2!3m1!1s0x0:0x59a3c81ec7245a58?hl=en-US" target="_blank" rel="noopener">View Map</a><br>
                                                                <br>
                                                                <br>
                                                                </td><td class="column-3">Manager-Service<br>
                                                                9539009737<br>
                                                                wm.muvattupuzha@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                Arakkuzha Road,Perumpalloor PO<br>
                                                                Muvattupuzha--PIN-686673<br>
                                                                Ph No - 953 900 9737 ,&nbsp;808 607 2361<br>
                                                                Break Down Service : 953 900 7373</td>
                                                                </tr><tr class="row-36 even" role="row">
                                                                <td class="column-1">27</td><td class="column-2">North Service<br>
                                                                <a href="https://www.google.com/maps/place/Popular+Vehicles+and+Services+Ltd/@9.988681,76.287421,18z/data=!4m2!3m1!1s0x0:0xfae56468f390e967?hl=en-US" target="_blank" rel="noopener">View Map</a><br>
                                                                <br>
                                                                <br>
                                                                <br>
                                                                </td><td class="column-3">Manager-Service<br>
                                                                984 629 8618<br>
                                                                wm.north@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                Opp. Lisie Hospital<br>
                                                                Ernakulam North<br>
                                                                Cochin/Kochi - 682 018<br>
                                                                Ph No. 984 670 3395<br>
                                                                Break Down Service : 9846298620</td>
                                                                </tr><tr class="row-37 odd" role="row">
                                                                <td class="column-1">28</td><td class="column-2">Pala Service<br>
                                                                <a href="https://www.google.com/maps/place/Popular+Vehicles+26+Services+Ltd+Pala/@9.6970024,76.6836794,17z/data=!3m1!4b1!4m5!3m4!1s0x3b07cdb2e9a6a87f:0xc07973c1ae5dd358!8m2!3d9.6970024!4d76.6858681?hl=en-US" target="_blank" rel="noopener">View Map</a></td><td class="column-3">Manager-Service<br>
                                                                907 260 9475<br>
                                                                wm.pala@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                12th Mail<br>
                                                                Pala - Ponkunnam Road Pala P.O<br>
                                                                Pin-686575<br>
                                                                Ph No - 0482 220 1830 , 0482 220 1831<br>
                                                                Break Down Service : 953 900 7370</td>
                                                                </tr><tr class="row-38 even" role="row">
                                                                <td class="column-1">29</td><td class="column-2">Palakad service<br>
                                                                <a href="https://www.google.com/maps/place/Popular+Vehicles+%26+Services+Ltd,+Opp+Paalana+Hospital,+Koduvayoor+Road/@10.780312,76.283486,18z/data=!4m2!3m1!1s0x0:0xcb7390390d644783?hl=en-US" target="_blank" rel="noopener">View Map</a><br>
                                                                <br>
                                                                <div style="display:none"><div id="form-lightbox-map130" style=""><br>
                                                                </div></div>
                                                                <script type="text/javascript">
                                                                var iFrame_map130 = jQuery("#form-lightbox-map130 iframe").attr("src");
                                                                jQuery(document).ready(function() {jQuery(".fl_box-map130").colorbox({
                                                                inline : true,
                                                                href :"#form-lightbox-map130",
                                                                transition : "elastic",speed : 350,scrolling : true,opacity : 0.85,returnFocus : true,fastIframe : true,closeBtn : true,escKey : true,
                                                                onClosed : function(){ jQuery("#form-lightbox-map130 iframe").attr("src", iFrame_map130); }
                                                                });
                                                                });
                                                                </script><br>
                                                                </td><td class="column-3">Manager-Service<br>
                                                                98463 00650<br>
                                                                wm.palakkad@popularv.com<br>
                                                                </td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                Opp Paalana Hospital<br>
                                                                Koduvayoor Road, Kinassery P.O.<br>
                                                                Palakkad - 678 707<br>
                                                                Ph No. 0491 252 2588, 0491 252 8588<br>
                                                                Break Down Service : 984 606 6666</td>
                                                                </tr><tr class="row-39 odd" role="row">
                                                                <td class="column-1">30</td><td class="column-2">Pathanamthitta service<br>
                                                                <a href="https://www.google.com/maps/place/Popular+Vehicles+and+Services+ltd/@9.265727,76.779295,18z/data=!4m2!3m1!1s0x0:0xb50ec2925ba73639?hl=en-US" target="_blank" rel="noopener">View Map</a><br>
                                                                </td><td class="column-3">Manager-Service<br>
                                                                9539009734<br>
                                                                wm.pta@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                near Gurumandiram<br>
                                                                Collectorate Junction<br>
                                                                Pathanamthitta-689645<br>
                                                                Ph No - 0468 232 5571 , 0468 232 5572, 0468 232 5576, 0468 232 5579<br>
                                                                Break Down Service : 953 900 9730</td>
                                                                </tr><tr class="row-40 even" role="row">
                                                                <td class="column-1">31</td><td class="column-2">Payannur service<br>
                                                                <a href="https://www.google.com/maps/place/Popular+Vehilces+%26+Services+Ltd,+NH-17,+Ezhilode,Payannur/@12.089524,75.251268,18z/data=!4m2!3m1!1s0x0:0xe5e71fa294a05a3?hl=en-US" target="_blank" rel="noopener">View Map</a><br>
                                                                </td><td class="column-3">Manager-Service<br>
                                                                994 610 4701<br>
                                                                wm.payyannur@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                NH-17,Ezhilode,Payannur<br>
                                                                PIN&nbsp;- 670309<br>
                                                                Ph No - 994 610 4701, 953 900 7383<br>
                                                                Break Down Service : 974 561 2300</td>
                                                                </tr><tr class="row-41 odd" role="row">
                                                                <td class="column-1">32</td><td class="column-2">Porur NEXA Service</td><td class="column-3">Quality Manager<br>
                                                                7092001199<br>
                                                                prr.srm.qm@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services  Ltd<br>
                                                                No.69/A &amp; 69/B, Samayapuram Main Road<br>
                                                                Opp. Siva Temple<br>
                                                                Near Venkateswara Homeopathic Medical College<br>
                                                                Porur, Chennai-600 116</td>
                                                                </tr><tr class="row-42 even" role="row">
                                                                <td class="column-1">33</td><td class="column-2">Retteri Service<br>
                                                                <a href="https://www.google.com/maps/place/Popular+Vehilces+%26+Services+Ltd,+No:+1402%2F2A,+200+Feet+Ring+Road,+Rettari+Junction/@13.137395,80.216059,16z/data=!4m2!3m1!1s0x0:0xb6617df14dbc09e6?hl=en-US" target="_blank" rel="noopener">View Map</a></td><td class="column-3">Manager-Service<br>
                                                                92821 01071<br>
                                                                wm_rettari@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                No: 1402/2A, 200 Feet Ring Road<br>
                                                                Rettari Junction, Kolathur<br>
                                                                Chennai-600 099<br>
                                                                Landmark : Opp to Kolathur RTO Office<br>
                                                                Ph No - 044 64 62 6410, 044 64 62 6411<br>
                                                                Break Down Service : 928 210 1066</td>
                                                                </tr><tr class="row-43 odd" role="row">
                                                                <td class="column-1">34</td><td class="column-2">Shornur Service<br>
                                                                <a href="https://www.google.com/maps/search/Popular+Vehicles+%26+Services+Palakkad+Ponnani+Rd+Kulappully,+Kerala+679122/@10.780089,76.283561,16z?hl=en-US" target="_blank" rel="noopener">View Map</a></td><td class="column-3">Manager-Service<br>
                                                                8589992432<br>
                                                                wm.shornur@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                OPP:KSEB Sub Station<br>
                                                                Palakkad Road<br>
                                                                Kulapully (P.O), Shornoor - 679122<br>
                                                                Ph No : 0466 222 0143, 0466 222 0173<br>
                                                                Break Down Service : 953 906 1119</td>
                                                                </tr><tr class="row-44 even" role="row">
                                                                <td class="column-1">35</td><td class="column-2">Sulthan Batheri Service</td><td class="column-3">Manager-Service<br>
                                                                8943345832<br>
                                                                sbr.srm.wm@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services  Ltd<br>
                                                                Pathiripalam, Kolagappara P.O<br>
                                                                Krishnagiri&nbsp; Village<br>
                                                                Sulthanbathery<br>
                                                                Wyanad -673 591</td>
                                                                </tr><tr class="row-45 odd" role="row">
                                                                <td class="column-1">36</td><td class="column-2">Thodupuzha<br>
                                                                <a href="https://www.google.com/maps/place/Popular+Automobiles/@9.9084538,76.7183245,17z/data=!3m1!4b1!4m5!3m4!1s0x0:0x84bc82b257bc9574!8m2!3d9.9084538!4d76.7205132?hl=en">View Map</a><br>
                                                                </td><td class="column-3">Manager-Service<br>
                                                                9072530120<br>
                                                                tdp.srm.wm@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                Mangattukavala<br>
                                                                Vengalloor By Pass Road<br>
                                                                Thodupuzha East P.O<br>
                                                                Thodupuzha, Idukki Dist.<br>
                                                                Pin- 685 585<br>
                                                                0486 2223226</td>
                                                                </tr><tr class="row-46 even" role="row">
                                                                <td class="column-1">37</td><td class="column-2">Thrissur Service<br>
                                                                <a href="https://www.google.com/maps/place/Popular+Vehicles+%26+Services/@10.526586,76.242316,18z/data=!4m2!3m1!1s0x0:0x40f1b372c021e77d?hl=en-US" target="_blank" rel="noopener">View Map</a><br>
                                                                <br>
                                                                </td><td class="column-3">Manager-Service<br>
                                                                9846261141<br>
                                                                wm.tsr@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                Kunnathumkara, Paravattani<br>
                                                                Thrissur - 680 655<br>
                                                                Ph No. 808 689 8028 ,953 900 9764<br>
                                                                Break Down Service : 984 616 1119</td>
                                                                </tr><tr class="row-47 odd" role="row">
                                                                <td class="column-1">38</td><td class="column-2">Thriprayar service<br>
                                                                <a href="https://www.google.com/maps/place/Popular+Vehicles+%26+services+Ltd,+Near+Century+Plaza,+Nattika+P.O./@10.416739,76.107257,18z/data=!4m2!3m1!1s0x0:0xaa08d6cc1cf8eeaf?hl=en-US" target="_blank" rel="noopener">View Map</a></td><td class="column-3">Manager-Service<br>
                                                                98466 99245<br>
                                                                wm.thriprayar@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                Near Century Plaza, Nattika P.O.<br>
                                                                Triprayar, Thrissur - 680 566<br>
                                                                Ph No. 0487 239 7128, 984 616 1129<br>
                                                                Break Down Service : 984 656 1119</td>
                                                                </tr><tr class="row-48 even" role="row">
                                                                <td class="column-1">39</td><td class="column-2">Thiruvalla service<br>
                                                                <a href="https://g.page/maruti-service-thiruvalla?we" target="_blank" rel="noopener">View Map</a><br>
                                                                <br>
                                                                </td><td class="column-3">Manager-Service<br>
                                                                8086073489<br>
                                                                wm.thiruvalla@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                T.K.Road<br>
                                                                Opposite Erankavu Devi Temple<br>
                                                                Kavumbhagom<br>
                                                                Thiruvalla-689102, Pathanamthitta Dt<br>
                                                                Ph No - 808 607 3455, 808 607 3488<br>
                                                                Break Down Service : 808 607 3484</td>
                                                                </tr><tr class="row-49 odd" role="row">
                                                                <td class="column-1">40</td><td class="column-2">Trivandrum (2) - Killipalam Body Shop<br>
                                                                <a href="https://www.google.com/maps/place/Popular+Vehicles+%26+Services+Ltd,+CIT+Road,+Killippalam/@8.489489,76.964424,15z/data=!4m2!3m1!1s0x0:0x1865b5b3ff6a3fc7?hl=en-US" target="_blank" rel="noopener">View Map</a></td><td class="column-3">Manager-Service<br>
                                                                9946104601<br>
                                                                wm.tvm@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                CIT Road, Killippalam, <br>
                                                                Trivandrum  - 695 002<br>
                                                                Ph. No. (0471) 4401111<br>
                                                                Break Down Service 9846062105</td>
                                                                </tr><tr class="row-50 even" role="row">
                                                                <td class="column-1">41</td><td class="column-2">Uppala  Service<br>
                                                                <a href="https://www.google.com/maps/place/Popular+vehicles+and+services+limited,+Nattakkal+complex,+kaikamba,+uppala.p.o/@12.663694,74.91774,18z/data=!4m2!3m1!1s0x0:0xe8189d8fb3be3700?hl=en-US" target="_blank" rel="noopener">View Map</a><br>
                                                                <br>
                                                                <br>
                                                                <br>
                                                                </td><td class="column-3">Manager-Service<br>
                                                                8086078864<br>
                                                                wm.uppala@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                Natakkal Complex, Kaikamba<br>
                                                                Uppala - P O<br>
                                                                Kasaragod<br>
                                                                Ph No - 858 999 2575, 907 260 9187<br>
                                                                Break Down Service : 894 334 5958<br>
                                                                </td>
                                                                </tr><tr class="row-51 odd" role="row">
                                                                <td class="column-1">42</td><td class="column-2">Vadakara Service<br>
                                                                <a href="https://www.google.com/maps/place/Popular+Vehicles+and+Services+ltd,+byepasss,+Pachakkil,+Malaparamba+P+O/@11.280987,75.803316,18z/data=!4m2!3m1!1s0x0:0x8923b97fb6f2330f?hl=en-US" target="_blank" rel="noopener">View Map</a></td><td class="column-3">Manager-Service<br>
                                                                8086078651<br>
                                                                wm.vka@popularv.com<br>
                                                                </td><td class="column-4">Popular Vehicles &amp; Services Ltd.<br>
                                                                Near Madappally Govt College<br>
                                                                Madappally P O<br>
                                                                Vadakara-673102<br>
                                                                Ph no- 894 334 5936, 894 334 5939<br>
                                                                Break Down Service : 994 640 0511</td>
                                                                </tr><tr class="row-52 even" role="row">
                                                                <td class="column-1">43</td><td class="column-2">Vanagaram</td><td class="column-3">Manager-Service<br>
                                                                9282100106<br>
                                                                vnm.srm.wm@popularv.com</td><td class="column-4">Popular Vehicles &amp; Services  Ltd<br>
                                                                No.10 Noombal<br>
                                                                Velappanchavadi<br>
                                                                Thiruverkadu, Vanagaram<br>
                                                                Chennai-600 077</td>
                                                                </tr><tr class="row-53 odd" role="row">
                                                                <td class="column-1">44</td><td class="column-2">Virugambakkam Body Shop<br>
                                                                <a href="https://www.google.com/maps/place/Maruti+Services+Centre+Boady+Shop/@13.0470501,80.188777,17z/data=!4m5!3m4!1s0x0:0xba42f2ac276bfdb7!8m2!3d13.0470502!4d80.1909658?hl=en">View Map</a></td><td class="column-3">Works Manager<br>
                                                                928 220 0443 <br>
                                                                chennaibodyshop@popularv.com<br>
                                                                </td><td class="column-4">Popular Vehicles &amp; Services Ltd.,<br>
                                                                9-51, Aranganathan Nagar, <br>
                                                                Virugambakkam, Chennai,<br>
                                                                Tamil Nadu 600092<br>
                                                                Ph No. 996 227 9933, 928 240 1700<br>
                                                                Break Down Service : 928 211 5566</td>
                                                                </tr><tr class="row-54 even" role="row">
                                                                <td class="column-1"><div style="display:none"><div id="form-lightbox-map1" style=""><br>
                                                                <br>
                                                                </div></div>
                                                                </td><td class="column-2"></td><td class="column-3"></td><td class="column-4"></td>
                                                                </tr></tbody>
                                                                </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="tab-pane fade show" id="nav-popular-usedcars" role="tabpanel" aria-labelledby="nav-sales-tab">

                                        <div class="bs-usedcars">
                                            <div class="accordion" id="accordion-usedcars">
                                                <div class="card">
                                                    <div class="card-header" id="heading-showroom">
                                                        <h2 class="mb-0">
                                                            <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne">
                                                            <i class="fa fa-plus"></i> MARUTI TRUE VALUES</button>
                                                        </h2>
                                                    </div>
                                                    <div id="collapseOne" class="collapse show" aria-labelledby="heading-showroom" data-parent="#accordion-usedcars">
                                                        <div class="card-body">
                                                            <table id="tablepress-8" class="table" role="grid">
                                                                <thead>
                                                                <tr class="row-1 odd" role="row"><th class="column-1 sorting_disabled" rowspan="1" colspan="1" style="width: 20px;">&nbsp;</th><th class="column-2 sorting_disabled" rowspan="1" colspan="1" style="width: 155px;">Branches<br>
                                                                </th><th class="column-3 sorting_disabled" rowspan="1" colspan="1" style="width: 235px;">Branch heads<br>
                                                                </th><th class="column-4 sorting_disabled" rowspan="1" colspan="1" style="width: 265px;">Branch Address<br>
                                                                </th></tr>
                                                                </thead>
                                                                <tbody class="row-hover"><tr class="row-2 even" role="row">
                                                                <td class="column-1">1</td><td class="column-2">Cochin  MTV<br>
                                                                <a href="https://www.google.com/maps/place/Popular+Vehicles+%26Services+Ltd,+Near+St+Thomas+Orthdox+Church,+S+H+Mount+P.O.Chavittuvary/@9.609174,76.532791,18z/data=!4m2!3m1!1s0x0:0xc6e9b8df0954e7db?hl=en-US" target="_blank" rel="noopener noreferrer">View Map</a></td><td class="column-3">Goldy Thomas<br>
                                                                Manager<br>
                                                                98464 98623<br>
                                                                goldy@popularv.com<br>
                                                                </td><td class="column-4">Popular True Value Division<br>
                                                                Kuttukaren Center<br>
                                                                Mamangalam-682025<br>
                                                                Ph no-0484-2338302, 9846298603 8589992637 accts<br>
                                                                Fax No. (0484) 2530644<br>
                                                                </td>
                                                                </tr><tr class="row-3 odd" role="row">
                                                                <td class="column-1">2</td><td class="column-2">Chennai MTV<br>
                                                                <a href="https://www.google.com/maps/place/Popular+True+Value+Division,+No.+5%2F9+MTH+ROAD,OPP+SH+ELL+PETROL+PUMP/@13.09821,80.178424,18z/data=!4m2!3m1!1s0x0:0xee7e16990d0f7aa8?hl=en-US" target="_blank" rel="noopener noreferrer">View Map</a></td><td class="column-3">Vadivelu<br>
                                                                Branch Head<br>
                                                                09677177781<br>
                                                                vadivelu.thirunavukkarasu@popularv.com<br>
                                                                </td><td class="column-4">Popular True Value Division<br>
                                                                No. 5/9 MTH ROAD,<br>
                                                                OPP SHELL PETROL PUMP<br>
                                                                PADI, Chennai 600 050<br>
                                                                Ph. No. (044)  23761601<br>
                                                                </td>
                                                                </tr><tr class="row-4 even" role="row">
                                                                <td class="column-1">3</td><td class="column-2">Kottayam MTV<br>
                                                                <a href="https://www.google.com/maps/place/Popular+Vehicles+%26Services+Ltd,+Near+St+Thomas+Orthdox+Church,+S+H+Mount+P.O.Chavittuvary/@9.609174,76.532791,18z/data=!4m2!3m1!1s0x0:0xc6e9b8df0954e7db?hl=en-US" target="_blank" rel="noopener noreferrer">View Map</a><br>
                                                                </td><td class="column-3">Subash Ramakrishnan<br>
                                                                Branch Head<br>
                                                                9946104633<br>
                                                                subashr@popularv.com<br>
                                                                </td><td class="column-4">Popular True Value Division<br>
                                                                Near St Thomas Orthdox Church<br>
                                                                Chavittuvary, S H Mount P.O.<br>
                                                                Kottayam - 06<br>
                                                                Ph No. (0481) 6512777,6450999, 6512333<br>
                                                                9446202827 accts<br>
                                                                </td>
                                                                </tr><tr class="row-5 odd" role="row">
                                                                <td class="column-1">4</td><td class="column-2">Calicut MTV<br>
                                                                <a href="https://www.google.com/maps/place/Popular+Vehicles+And+Services+Limited/@11.281309,75.787317,18z/data=!4m2!3m1!1s0x0:0xc8612cd71b287ae7?hl=en-US" target="_blank" rel="noopener noreferrer">View Map</a></td><td class="column-3">Ison Abraham<br>
                                                                90726 09225<br>
                                                                clt.mtv.am@popularv.com<br>
                                                                </td><td class="column-4">Popular True Value Division<br>
                                                                Palattuthazham, Civil Station (PO),<br>
                                                                Eranhipalam,<br>
                                                                Calicut<br>
                                                                Ph: 0495 2372555,0495-2372566<br>
                                                                </td>
                                                                </tr><tr class="row-6 even" role="row">
                                                                <td class="column-1">5</td><td class="column-2">Trivandrum MTV<br>
                                                                <a href="https://www.google.com/maps/place/Popular+Vehicles+%26+Services+Ltd,+CIT+Road,+Killippalam/@8.489489,76.964424,15z/data=!4m2!3m1!1s0x0:0x1865b5b3ff6a3fc7?hl=en-US" target="_blank" rel="noopener noreferrer">View Map</a><br>
                                                                </td><td class="column-3">Ganesh Kumar.S<br>
                                                                Manager<br>
                                                                98460 63013<br>
                                                                ganesh@popularv.com<br>
                                                                </td><td class="column-4">Popular True Value Division<br>
                                                                CIT Road, Opp. St. Jude’s Church<br>
                                                                Killippalam<br>
                                                                Tvm – 695 002<br>
                                                                Ph No. (0471) 2348321, 6512777<br>
                                                                Accts - 4175000<br>
                                                                </td>
                                                                </tr><tr class="row-7 odd" role="row">
                                                                <td class="column-1">6</td><td class="column-2">Thrissur MTV<br>
                                                                <a href="https://www.google.com/maps/place/Popular+True+Value+Division,+Opp.Ollukkara+grama+Panchayath,+Ollukkara+.p.o/@10.526971,76.254384,18z/data=!4m2!3m1!1s0x0:0x5c04fabf53620546?hl=en-US" target="_blank" rel="noopener noreferrer">View Map</a></td><td class="column-3">Binu K Joy<br>
                                                                9946104670<br>
                                                                tsr.mtv.bh@popularv.com<br>
                                                                </td><td class="column-4">Popular True Value Division<br>
                                                                Opp.Ollukkara grama Panchayath<br>
                                                                Ollukkara .p.o<br>
                                                                Mannuthy road<br>
                                                                Thrissur--680655<br>
                                                                0487-2372872,-9846498660, accts 8943345989</td>
                                                                </tr></tbody>
                                                                </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="tab-pane fade" id="nav-maruti-driving-schools" role="tabpanel" aria-labelledby="nav-service-tab">

                                        <div class="bs-driving-schools">
                                            <div class="accordion" id="accordion-driving-schools">
                                                <div class="card">
                                                    <div class="card-header" id="heading-showroom">
                                                        <h2 class="mb-0">
                                                            <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne">
                                                            <i class="fa fa-plus"></i> MARUTI DRIVING SCHOOLS</button>
                                                        </h2>
                                                    </div>
                                                    <div id="collapseOne" class="collapse show" aria-labelledby="heading-showroom" data-parent="#accordion-driving-schools">
                                                        <div class="card-body">
                                                            <table id="tablepress-50" class="table" role="grid">
                                                                <thead>
                                                                <tr class="row-1 odd" role="row"><th class="column-1 sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">&nbsp;</th><th class="column-2 sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">Regional Manager<br>
                                                                </th><th class="column-3 sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">Susheel Thomas<br>
                                                                9946105650<br>
                                                                </th><th class="column-4 sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">&nbsp;</th><th class="column-5 sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">&nbsp;</th></tr>
                                                                </thead>
                                                                <tbody class="row-hover">
                                                                <tr class="row-2 even" role="row">
                                                                <td class="column-1"></td><td class="column-2">Kadavanthra MDS<br>
                                                                <a href="https://www.google.com/maps/place/Popular+Maruti+Driving+School,+Emmy+Square,+Opp.+Easland+Enclave/@9.967189,76.307771,18z/data=!4m2!3m1!1s0x0:0x90f5a80754ea124e?hl=en-US" target="_blank">View Map</a></td><td class="column-3">Govinda Marar<br>
                                                                Supervisor<br>
                                                                Ph: 9072530087<br>
                                                                Email: chnmds@popularv.com</td><td class="column-4">Popular Maruti Driving School<br>
                                                                Emmy Square, Opp. Easland Enclave<br>
                                                                Elamkulam<br>
                                                                Cochin/Kochi - 682024<br>
                                                                Ph No. 0484 - 2206562</td><td class="column-5"></td>
                                                                </tr><tr class="row-3 odd" role="row">
                                                                <td class="column-1"></td><td class="column-2">Calicut MDS<br>
                                                                <a href="https://www.google.com/maps/place/Popular+Vehicles+And+Services+Limited/@11.281309,75.787317,18z/data=!4m2!3m1!1s0x0:0xc8612cd71b287ae7?hl=en-US" target="_blank">View Map</a></td><td class="column-3">Abdul Sathar P<br>
                                                                Manager<br>
                                                                Ph: 9020110708<br>
                                                                Email: clt.mds.bm@popularv.com</td><td class="column-4">Popular Maruti Driving School<br>
                                                                near Maruti true Value<br>
                                                                Palattuthazham<br>
                                                                civil station P O<br>
                                                                Calicut-20<br>
                                                                Ph no- 0495- 2374101, 9020110708.</td><td class="column-5"></td>
                                                                </tr><tr class="row-4 even" role="row">
                                                                <td class="column-1"></td><td class="column-2">Edappally MDS<br>
                                                                <a href="https://www.google.com/maps/place/Popular+Maruti+Driving+School,+Near+Modern+bread+Co./@10.012944,76.302267,16z/data=!4m2!3m1!1s0x0:0xc23b7224448fc4a2?hl=en-US" target="_blank">View Map</a></td><td class="column-3">Benny George<br>
                                                                Manager<br>
                                                                9142200047<br>
                                                                bennyg@popularv.com</td><td class="column-4">Popular Maruti Driving School<br>
                                                                Near Modern bread Co.<br>
                                                                Edappally Cochin/Kochi - 682024<br>
                                                                ph no-0484-2341122, 2341199</td><td class="column-5"></td>
                                                                </tr><tr class="row-5 odd" role="row">
                                                                <td class="column-1"></td><td class="column-2">Kottayam MDS<br>
                                                                <a href="https://www.google.com/maps/place/Popular+Vehicles+%26Services+Ltd,+Near+St+Thomas+Orthdox+Church,+S+H+Mount+P.O.Chavittuvary/@9.609174,76.532791,18z/data=!4m2!3m1!1s0x0:0xc6e9b8df0954e7db?hl=en-US" target="_blank">View Map</a></td><td class="column-3">Kevin Kennedy<br>
                                                                Manager<br>
                                                                Ph: 8589998180<br>
                                                                Email: ktm.mds.bm@popularv.com</td><td class="column-4">Popular Maruti Driving School<br>
                                                                Near St Thomas Orthdox Church<br>
                                                                Chavittuvary, S H Mount P.O.<br>
                                                                Kottayam - 06<br>
                                                                Ph No. 0481- 6614594, 8589998180. </td><td class="column-5"></td>
                                                                </tr><tr class="row-6 even" role="row">
                                                                <td class="column-1"></td><td class="column-2">Thrissur MDS<br>
                                                                <a href="https://www.google.com/maps/place/Popular+Vehicles+%26+Services/@10.516938,76.213172,16z/data=!4m2!3m1!1s0x0:0xb664d5a1b073d8bc?hl=en-US" target="_blank">View Map</a></td><td class="column-3">Yakesh Kumar P M<br>
                                                                Manager<br>
                                                                Ph: 9072355070<br>
                                                                Email: tsr.mds.bm@popularv.com</td><td class="column-4">Popular Maruti Driving School<br>
                                                                TUDA ROAD<br>
                                                                PERINGAVU,Thirumbadi<br>
                                                                THRISSUR-680002<br>
                                                                Ph no- (0487) 2221060, 9072355070</td><td class="column-5"></td>
                                                                </tr><tr class="row-7 odd" role="row">
                                                                <td class="column-1"></td><td class="column-2">PALA MDS<br>
                                                                <a href="https://www.google.com/maps/place/Popular+Maruti+Driving+School/@9.704364,76.668383,18z/data=!4m2!3m1!1s0x0:0x91d996afd692650f?hl=en-US" target="_blank">View Map</a></td><td class="column-3">Renju Chandran<br>
                                                                Supervisor<br>
                                                                Ph: 9072609728<br>
                                                                Email: pala.mds.bm@popularv.com</td><td class="column-4">Popular Maruti Driving School<br>
                                                                Vypana bldg.<br>
                                                                Near Alphonsa College<br>
                                                                Oorassala jn<br>
                                                                Arunapuram P O<br>
                                                                Pala – 686574<br>
                                                                Ph No – 0482 2213377,<br>
                                                                0482 2214477<br>
                                                                </td><td class="column-5"></td>
                                                                </tr><tr class="row-8 even" role="row">
                                                                <td class="column-1"></td><td class="column-2">Trivandrum MDS<br>
                                                                <a href="https://www.google.com/maps/place/Popular+Vehicles+and+Servces+Ltd,+Near+canara+bank,+paruttipara+jn/@8.535556,76.942569,18z/data=!4m2!3m1!1s0x0:0x1ea0382350785cf2?hl=en-US" target="_blank">View Map</a><br>
                                                                </td><td class="column-3">Abhilash Ashok<br>
                                                                Manager<br>
                                                                9539400054<br>
                                                                Email: par.mds.bm@popularv.com</td><td class="column-4">Popular Maruti Driving School<br>
                                                                TC 3/145, Near Canara Bank<br>
                                                                MC Road, Paruthipara Jn.<br>
                                                                Trivandrum, 695015<br>
                                                                Ph: (0471) 2530003, 9072530092. </td><td class="column-5"></td>
                                                                </tr><tr class="row-9 odd" role="row">
                                                                <td class="column-1"></td><td class="column-2"></td><td class="column-3"></td><td class="column-4"></td><td class="column-5"></td>
                                                                </tr></tbody>
                                                                </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endif
            <!-- ABOUT -->
            <div class="container contactPremier">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="hero__form carBooking bg-white tabbed-single-form">
                            <h3 class="text-left"><span class="text-primary">QUICK ENQUIRY</span></h3>
                            @if (session('error'))
                                <div class="alert alert-danger alert-dismissable" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>{{ session('error') }}
                                </div>
                            @endif
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissable" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>{{ session('success') }}
                                </div>
                            @endif
                            <div id="validation-error" class="d-none">
                                <div class="alert alert-danger alert-dismissable" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    <p class="mb-0">{{ session('error') }}</p>
                                </div>
                            </div>
                            <div id="buynewcar_mainform">
                            @include('forms.buynewcar_form')
                            </div>
                            <div class="d-none enter-otp-div">
                                @include('forms.otp_form')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END ABOUT -->

        </section>
    </main>
@endsection
@section('js_after')
    <script>
        $(document).ready(function() {
            $('.formPageName').val("enquiry");
        });
        $("#buynewcarloc").select2();
        $(document).ready(function() {
            $('#buynewcar-form').parsley();
            $('#buynewcar-form').on('submit', function(event) {
                event.preventDefault();
                if ($('#buynewcar-form').parsley().isValid()) {
                    $.ajax({
                        url: "{{ route('sent_otp_buy_new_car') }}",
                        method: "POST",
                        data: $(this).serialize(),
                        success: function(data) {
                            if (data.status) {
                                $(".enter-otp-div").removeClass("d-none");
                                $("#buynewcar_mainform").addClass("d-none");
                                $(".mode").val(data.mode);
                                $(".enquiry_id").val(data.id);
                            } else {
                                if(data.message == 'Failed to send OTP') {
                                    var validation = '';
                                        validation = validation +
                                            '<div class="alert alert-danger alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><p class="mb-0">' +
                                                data.message + '</p></div>';
                                    $("#validation-error").removeClass("d-none");
                                    $("#validation-error").html(validation);
                                } else {
                                    var validation = '';
                                    jQuery.each(data.message, function(index, item) {
                                        validation = validation +
                                            '<div class="alert alert-danger alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><p class="mb-0">' +
                                            item + '</p></div>';
                                    });
                                    $("#validation-error").removeClass("d-none");
                                    $("#validation-error").html(validation);
                                }
                            }
                        }
                    });
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Add minus icon for collapse element which is open by default
            $(".collapse.show").each(function() {
                $(this).prev(".card-header").find(".fa").addClass("fa-minus").removeClass("fa-plus");
            });

            // Toggle plus minus icon on show hide of collapse element
            $(".collapse").on('show.bs.collapse', function() {
                $(this).prev(".card-header").find(".fa").removeClass("fa-plus").addClass("fa-minus");
            }).on('hide.bs.collapse', function() {
                $(this).prev(".card-header").find(".fa").removeClass("fa-minus").addClass("fa-plus");
            });
        });
    </script>
@endsection
