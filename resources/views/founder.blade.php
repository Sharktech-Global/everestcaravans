@extends('layouts.app')

@section('content')
    <!-- BANNER -->
    <section class="hero set-bg min-height-450 overlay"
        data-setbg="{{ asset('assets/images/background/founder.png') }}">
        <div class="container">
            <div class="text-center row">
                <h1 class="text-center text-white col-md-12">About Founder</h1>
                <div class="text-center breadcrumbs col-md-12">
                    <p class="text-white"><a href="{{ route('home') }}">Home</a> <i class="mx-2 fa fa-angle-right"
                            aria-hidden="true"></i>
                        <span>About Founder</span>
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- END BANNER -->
    <main id="content">
        <section class="pt-100 bg-black" style="padding-bottom: 100px !important;">

            <!-- ABOUT -->
            <div class="container py-5">
                <div class="row">
                   <p> In the year 1939, Mr. K. P. Paul started his business career with a laundry service called Popular Washing Home. He dared the tradition and started reaping success in six months.
                     This venture brought forth his daring nature that remained the backbone of his life and business in the years to come. He was a born leader and believed in employee empowerment and satisfaction.
                      He motivated employees who delivered impeccable customer service.</p>

                   <p>    Mr. KP Paul was a visionary. In the year 1941 he diversified into tyre , tube vulcanizing and battery restoration business.
                       When the 2nd world war came to a closure, he found ample opportunity in the spare parts business by procuring the surplus spare parts of military vehicles.
                        In the year 1944, he established Popular Automobiles, which became one of India’s largest chain store dealing in spare parts. The business grew by exponential proposition and catapulted him to fame.
                        He further forayed into imported and new automobile parts.
                        It had a pan India presence with offices at Bangalore, Chennai, Mumbai and Calcutta.</p>
                        <p>
                        K. P. Paul was an entrepreneur par excellence and entrepreneurship is the key word in any remarkably growing business.
                        In his business growth he made thousands of people and families self sustaining. Hundreds of his former employees are successful business people today.
                        He did not believe in charity, he wanted people to work hard and succeed. He was an epitome of dedication, hard work and humility.
                         His humble demeanour won many hearts and he had a committed workforce and loyal customers.
                         Based on this success saga the Kuttukaran Group has adopted its vision “Kuttukaran will be the world’s most Admired Corporate by Progressively Delivering Greater Value, through Entrepreneurship within”</p>
                         <p>
                        The journey still continues under his guiding spirit……</p><br>

                </div>
                <div class="row">
                   <a class="text-white btn btn-info"   href="https://buybooks.mathrubhumi.com/product/athikayan-2/" target="_blank" rel="noopener noreferrer">Buy Ath Kayan - Biography of K. P. Paul</a>
                </div>
            </div>
            <!-- END ABOUT -->

        </section>

    </main>
@endsection

@section('js_after')
    <script>
        /*function lightbox(idx) {
            var ninjaSldr = document.getElementById("ninja-slider");
            ninjaSldr.parentNode.style.display = "block";
            nslider.init(idx);
            var fsBtn = document.getElementById("fsBtn");
            fsBtn.click();
        }

        function fsIconClick(isFullscreen, ninjaSldr) {
            if (isFullscreen) {
                ninjaSldr.parentNode.style.display = "none";
            }
        }*/

    </script>
@endsection
