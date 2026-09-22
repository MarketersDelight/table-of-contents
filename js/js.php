<script>

tableOfContents: function() {
	var toc = document.querySelector( '.toc' );

	if ( ! toc )
		return;

	var floatingAnchor, floatingTitle,
		selectedIndex = null,
		activeIndex = -1,
		headings = [],
		content = document.getElementById( 'the_content' ),
		main = document.getElementById( 'main' ),
		toggle = toc.querySelector( '.toc-toggle' ),
		contentHeadings = Array.from( content.querySelectorAll( 'h2, h3, h4, h5, h6' ) ),
		items = Array.from( toc.querySelectorAll( '.toc-item' ) ),
		links = Array.from( toc.querySelectorAll( '.toc-item-label' ) ),
		desktop = window.matchMedia( '(min-width: 900px)' ),
		floatingToc = toc.classList.contains( 'toc-float' ) && toc.classList.contains( 'toc-sticky' ) ? toc : null;

	var contentIndex = 0;

	for ( var i = 0; i < links.length; i++ ) {
		var linkedTarget = document.getElementById( links[i].getAttribute( 'href' ).slice( 1 ) );

		if ( linkedTarget && ! content.contains( linkedTarget ) )
			headings.push( linkedTarget );
		else
			headings.push( contentHeadings[contentIndex++] );
	}

	function setOpen( isOpen ) {
		toc.classList.toggle( 'open', isOpen );
		toggle.setAttribute( 'aria-expanded', isOpen );
	}

	function toggleActiveItem( index, isActive ) {
		if ( index < 0 )
			return;

		var item = items[index];

		item.classList.toggle( 'active', isActive );
		item.classList.remove( 'collapsed-toc-item' );

		if ( ! item.parentNode.classList.contains( 'toc-sublist' ) )
			return;

		var parent = item.parentNode.parentNode,
			parentToggle = parent.querySelector( '.toc-item-toggle' );

		parent.classList.toggle( 'child-active', isActive );
		parentToggle.setAttribute( 'aria-expanded', isActive || parent.classList.contains( 'toggle-toc-item' ) );
	}

	function setActiveItem( index ) {
		if ( activeIndex === index )
			return;

		toggleActiveItem( activeIndex, false );
		activeIndex = index;
		toggleActiveItem( activeIndex, true );
	}

	function updateFloatingState( scrollY, stickyOffset ) {
		if ( ! floatingToc )
			return 0;

		var threshold = floatingAnchor.getBoundingClientRect().top + scrollY,
			isStuck = desktop.matches && scrollY + stickyOffset >= threshold,
			floatingHeight = isStuck ? floatingTitle.offsetHeight : 0;

		floatingToc.classList.toggle( 'stuck', isStuck );
		main.style.setProperty( '--toc-floating-height', floatingHeight + 'px' );

		if ( ! isStuck )
			setOpen( false );

		return floatingHeight;
	}

	function update( scrollY ) {
		var styles = window.getComputedStyle( main ),
			stickyOffset = parseFloat( styles.getPropertyValue( '--toc-sticky-offset' ) ),
			floatingHeight = updateFloatingState( scrollY, stickyOffset ),
			scrollGap = parseFloat( styles.getPropertyValue( '--toc-scroll-gap' ) ),
			headingOffset = stickyOffset + floatingHeight + scrollGap,
			nextActiveIndex = -1;

		for ( var i = 0; i < headings.length; i++ ) {
			if ( headings[i].getBoundingClientRect().top > headingOffset )
				break;

			nextActiveIndex = i;
		}

		var pageHeight = Math.max( document.body.scrollHeight, document.documentElement.scrollHeight ),
			atPageEnd = Math.ceil( scrollY + window.innerHeight ) >= pageHeight;

		if ( atPageEnd )
			nextActiveIndex = headings.length - 1;

		setActiveItem( selectedIndex === null ? nextActiveIndex : selectedIndex );
	}

	var usedIds = {};

	for ( var i = 0; i < headings.length; i++ ) {
		var baseId = headings[i].id || links[i].getAttribute( 'href' ).slice( 1 ) || 'section-' + ( i + 1 ),
			headingId = baseId,
			suffix = 2;

		while ( usedIds[headingId] )
			headingId = baseId + '-' + suffix++;

		usedIds[headingId] = true;
		headings[i].id = headingId;
		links[i].setAttribute( 'href', '#' + headingId );
		headings[i].classList.add( 'toc-heading' );
	}

	if ( floatingToc ) {
		floatingAnchor = document.createElement( 'span' );
		floatingAnchor.className = 'toc-float-anchor';
		floatingAnchor.setAttribute( 'aria-hidden', 'true' );
		floatingToc.parentNode.insertBefore( floatingAnchor, floatingToc );
		floatingTitle = floatingToc.querySelector( '.widget-title' );
	}

	toc.addEventListener( 'click', function( event ) {
		var itemToggle = event.target.closest( '.toc-item-toggle' ),
			link = event.target.closest( '.toc-item-label' );

		if ( event.target.closest( '.toc-toggle' ) )
			setOpen( ! toc.classList.contains( 'open' ) );

		else if ( itemToggle ) {
			var item = itemToggle.closest( '.toc-item' ),
				isOpen = ! item.classList.contains( 'collapsed-toc-item' ) && ( item.classList.contains( 'active' ) || item.classList.contains( 'child-active' ) || item.classList.contains( 'toggle-toc-item' ) );

			item.classList.toggle( 'toggle-toc-item', ! isOpen );
			item.classList.toggle( 'collapsed-toc-item', isOpen && ( item.classList.contains( 'active' ) || item.classList.contains( 'child-active' ) ) );
			itemToggle.setAttribute( 'aria-expanded', isOpen || item.classList.contains( 'child-active' ) );
		}

		else if ( link ) {
			event.preventDefault();

			var target = document.getElementById( link.getAttribute( 'href' ).slice( 1 ) );

			selectedIndex = headings.indexOf( target );
			setOpen( false );
			setActiveItem( selectedIndex );
			target.scrollIntoView( { behavior: 'smooth', block: 'start' } );
			window.history.pushState( {}, '', '#' + target.id );
		}
	} );

	function clearSelectedItem() {
		selectedIndex = null;
	}

	window.addEventListener( 'wheel', clearSelectedItem, { passive: true } );
	window.addEventListener( 'touchmove', clearSelectedItem, { passive: true } );
	window.addEventListener( 'keydown', function( event ) {
		var scrollKeys = [ 'ArrowUp', 'ArrowDown', 'PageUp', 'PageDown', 'Home', 'End', ' ' ];
		if ( scrollKeys.indexOf( event.key ) !== -1 )
			clearSelectedItem();
	} );
	window.addEventListener( 'popstate', clearSelectedItem );

	function updateStickyOffset() {
		var rootStyles = window.getComputedStyle( document.documentElement ),
			header = document.querySelector( '.header.sticky' ),
			adminBar = document.getElementById( 'wpadminbar' ),
			offset = parseFloat( rootStyles.getPropertyValue( '--md-half' ) );

		if ( header )
			offset += header.offsetHeight;

		if ( adminBar )
			offset += adminBar.offsetHeight;

		main.style.setProperty( '--toc-sticky-offset', offset + 'px' );
		update( window.scrollY );
	}

	function scrollToCurrentHeading() {
		if ( ! window.location.hash )
			return;

		var target = document.getElementById( window.location.hash.slice( 1 ) ),
			targetIndex = headings.indexOf( target );

		if ( targetIndex === -1 )
			return;

		selectedIndex = targetIndex;

		window.requestAnimationFrame( function() {
			target.scrollIntoView( { block: 'start' } );
			update( window.scrollY );
		} );
	}

	this.toc = { update: update };

	updateStickyOffset();
	scrollToCurrentHeading();

	window.addEventListener( 'load', function() {
		updateStickyOffset();
		scrollToCurrentHeading();
	} );
	window.addEventListener( 'resize', updateStickyOffset );
},
