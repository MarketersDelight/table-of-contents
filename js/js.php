<script>

tableOfContents: function() {
	var toc = document.getElementById( 'table_of_contents' );

	if ( ! toc )
		return;

	var	content = document.getElementById( 'the_content' ),
		labels = toc.querySelectorAll( '.toc-item-label' ),
		headings = content.querySelectorAll( 'h2, h3, h4, h5, h6' );

	function scrollTo( target ) {
		var inEntry = !! toc.closest( '.entry' ),
			preStuck = inEntry && ! toc.classList.contains( 'stuck' );

		if ( preStuck ) toc.classList.add( 'stuck' );

		var top = 0, el = target;
		while ( el ) { top += el.offsetTop; el = el.offsetParent; }
		var offset = inEntry ? toc.clientHeight : 0;

		if ( preStuck ) toc.classList.remove( 'stuck' );

		window.scrollTo({ top: top - offset, behavior: 'smooth' });
	}

	for ( var i = 0; i < labels.length; i++ )
		headings[i].setAttribute( 'id', labels[i].getAttribute( 'href' ).slice( 1 ) );

	toc.addEventListener( 'click', function( e ) {
		var label = e.target.closest( '.toc-item-label' );
		if ( ! label ) return;
		e.preventDefault();
		var id = label.getAttribute( 'href' ).slice( 1 ),
			target = document.getElementById( id );
		if ( ! target ) return;
		toc.classList.remove( 'open' );
		scrollTo( target );
		window.history.pushState( {}, '', '#' + id );
	} );

	toc.querySelector( '.widget-title' ).onclick = function() { toc.classList.toggle( 'open' ); };

	if ( 'scrollRestoration' in history )
		history.scrollRestoration = 'manual';

	window.addEventListener( 'popstate', function() {
		var hash = window.location.hash;
		if ( hash ) {
			var target = document.getElementById( hash.slice( 1 ) );
			if ( target ) scrollTo( target );
		}
		else window.scrollTo({ top: 0, behavior: 'smooth' });
	} );
},