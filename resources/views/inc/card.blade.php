
<div class='col l4 m6 s12 animated-card'>
    <div class='card small hoverable'>
        <div class='card-image waves-effect waves-block waves-light'>
            <img class='activator' src=@yield('card-path-image')>
        </div>
        <div class='card-content'>
            <span class='card-title activator grey-text text-darken-4'>@yield('card-title')<i class='material-icons right'>more_vert</i></span>
            <p><a target='_blank' href='/publication'>@yield('card-link-site')</a></p>
            <div class="card-footer">
            <small class="text-muted">@yield('card-time-ago')</small>
            </div>
        </div>
        <div class='card-reveal'>
            <span class='card-title grey-text text-darken-4'>@yield('card-title')<i class='material-icons right'>close</i></span>
            <p>
                @yield('card-description')
            </p>  
        </div>
    </div>
</div>
