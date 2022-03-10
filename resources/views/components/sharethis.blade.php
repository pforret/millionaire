        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg text-center text-sm text-blue-800">
            Share:
            <a href="https://twitter.com/intent/tweet?url=@yield('page_url')&title=@yield('page_title')"
               target="_blank">
                <i class="fa-brands fa-twitter"></i> Twitter
            </a>
            &bull;
            <a href="https://www.reddit.com/submit?url=@yield('page_url')&title=@yield('page_title')"
               target="_blank">
                <i class="fa-brands fa-reddit"></i> Reddit
            </a>
            &bull;
            <a href="https://www.linkedin.com/shareArticle?mini=true&url=@yield('page_url')"
               target="_blank">
                <i class="fa-brands fa-linkedin"></i> LinkedIn
            </a>
            &bull;
            <a href="https://www.facebook.com/sharer.php?u=@yield('page_url')"
               target="_blank">
                <i class="fa-brands fa-facebook"></i> Facebook
            </a>
        </div>
