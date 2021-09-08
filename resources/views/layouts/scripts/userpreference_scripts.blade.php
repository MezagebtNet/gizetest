<script>
    $('.select-lang').on('click', function(e){
        // e.preventDefault();
        // alert($(this).attr('hreflang'));
        let lang = $(this).attr('hreflang');
        let user_id = "{{ auth()->user()->id }}";
        let url = "{{ route('changelanguage', ['user_id' => ':user_id', 'lang' => ':lang']) }}";
        url = url.replace(':user_id', user_id);
        url = url.replace(':lang', lang);

        $.ajax({
            url: url,
            type: 'GET',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
            },
            success: function(response){
                //
            },
        });
    })

    $('.select-theme').on('click', function(e){
        e.preventDefault();
        // alert($(this).attr('hreflang'));
        let theme = ($(this).attr('theme') == 'light-mode') ? 'dark-mode' : 'light-mode';
        let user_id = "{{ auth()->user()->id }}";
        let url = "{{ route('changetheme', ['user_id' => ':user_id', 'theme' => ':theme']) }}";
        url = url.replace(':user_id', user_id);
        url = url.replace(':theme', theme);

        let el = $(this);

        $.ajax({
            url: url,
            type: 'GET',
            contentType: 'text',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
            },
            success: function(response){

                if(theme == 'light-mode'){
                    $('body').removeClass('dark-mode');
                    $('.select-theme .theme-switch').html(`<span><i class="fa fa-moon"></i> {{ __('Dark Mode') }}</span>`);


                }
                else if(theme == 'dark-mode'){
                    $('body').addClass(response);
                    $('.select-theme .theme-switch').html(`<span><i class="fa fa-sun"></i> {{ __('Light Mode') }}</span>`);

                }
                $('.select-theme').attr('theme', theme);

            },
        });
    });
</script>