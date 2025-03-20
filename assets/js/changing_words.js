(function ($, window, document, undefined) {
    var index   = -1;
    var timer   = null;
    var spanner = $( ".spanner" );
    var words   = $( ".words" );
    var word    = $( ".word" );
    function start () {
        index = -1;
        timer = setInterval( nextword, 2000 );
    }
    function change () {
        spanner.text( word.eq( index ).text() );
        words.css( 'top', -1 * index * ( word.height() ) );
        setTimeout( cleanup, 300 );
    }
    function cleanup () {
        word.removeClass( "on" );
        word.addClass( "off" );
        word.eq( index ).removeClass( "off" );
        word.eq( index ).addClass( "on" );
    }
    function restart () {
        words.addClass( "disabled" );
        index = 0;
        change();
    }
    function nextword () {
        index += 1;
        words.removeClass( "disabled" );
        word.removeClass( "off" );
        if ( index == word.length - 1 ) {
            setTimeout( restart, 300 );
        }
        change();
    }
    start();
} )( jQuery, window, document );