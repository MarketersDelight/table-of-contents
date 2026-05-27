<script>

tableOfContents: function() {
	var	contentBox = document.getElementById( 'main' ),
		content = document.getElementById( 'the_content' ),
		toc = document.getElementById( 'table_of_contents' ),
		labels = toc.querySelectorAll( '.toc-item-label' ),
		headings = content.querySelectorAll( 'h2, h3, h4, h5, h6' );

	for ( var i = 0; i < labels.length; i++ )
		headings[i].setAttribute( 'id', labels[i].getAttribute( 'href' ).slice( 1 ) );

	toc.addEventListener( 'click', function( e ) {
		var label = e.target.closest( '.toc-item-label' );
		if ( ! label ) return;
		e.preventDefault();
		var id = label.getAttribute( 'href' ).slice( 1 ),
			target = document.getElementById( id );
		if ( ! target ) return;
		window.scrollTo({ top: target.offsetTop + contentBox.offsetTop, behavior: 'smooth' });
		window.history.pushState( {}, '', '#' + id );
		MD.removeClass( toc, 'open' );
	} );

	toc.querySelector( '.widget-title' ).onclick = function() { MD.toggleClass( toc, 'open' ); };

	if ( 'scrollRestoration' in history )
		history.scrollRestoration = 'manual';

	window.addEventListener( 'popstate', function() {
		var hash = window.location.hash;
		if ( hash ) {
			var target = document.getElementById( hash.slice( 1 ) );
			if ( target )
				window.scrollTo({ top: target.offsetTop + contentBox.offsetTop, behavior: 'smooth' });
		}
		else window.scrollTo({ top: 0, behavior: 'smooth' });
	} );
},
