/**
 * navigation.js
 *
 * Handles toggling the navigation menu for small screens.
 */
( function () {
	var container, button, menu, links, i, len;

	container = document.getElementById( 'site-navigation' );
	if ( ! container ) {
		return;
	}

	button = container.getElementsByClassName( 'menu-toggle' )[0];
	if ( 'undefined' === typeof button ) {
		return;
	}

	menu = container.getElementsByTagName( 'ul' )[0];

	// Hide menu toggle button if menu is empty and return early.
	if ( 'undefined' === typeof menu ) {
		button.style.display = 'none';
		return;
	}

	if ( - 1 === menu.className.indexOf( 'nav-menu' ) ) {
		menu.className += 'nav-menu';
	}

	button.onclick = function () {
		if ( - 1 !== container.className.indexOf( 'main-small-navigation' ) ) {
			container.className = container.className.replace( 'main-small-navigation', 'main-navigation' );
		} else {
			container.className = container.className.replace( 'main-navigation', 'main-small-navigation' );
		}
	};

	// Get all the link elements within the menu.
	links = menu.getElementsByTagName( 'a' );

	// Each time a menu link is focused or blurred, toggle focus.
	for ( i = 0, len = links.length; i < len; i++ ) {
		links[i].addEventListener( 'focus', toggleFocus, true );
		links[i].addEventListener( 'blur', toggleFocus, true );
	}

	/**
	 * Sets or removes .focus class on an element.
	 */
	function toggleFocus() {
		var self = this;

		// Move up through the ancestors of the current link until we hit .nav-menu.
		while ( -1 === self.className.indexOf( 'nav-menu' ) ) {
			// On li elements toggle the class .focus.
			if ( 'li' === self.tagName.toLowerCase() ) {
				if ( -1 !== self.className.indexOf( 'focus' ) ) {
					self.className = self.className.replace( ' focus', '' );
				} else {
					self.className += ' focus';
				}
			}

			self = self.parentElement;
		}
	}
} )();

// Show Submenu on click on touch enabled deviced
( function () {
	var container;
	container = document.getElementById( 'site-navigation' );

	/**
	 * Toggles `focus` class to allow submenu access on tablets.
	 */
	( function ( container ) {
		var touchStartFn, i,
		    parentLink = container.querySelectorAll( '.menu-item-has-children > a, .page_item_has_children > a' );

		if ( ( 'ontouchstart' in window ) && ( window.matchMedia( "( min-width: 768px ) " ).matches ) ) {
			touchStartFn = function ( e ) {
				var menuItem = this.parentNode, i;

				if ( ! menuItem.classList.contains( 'focus' ) ) {
					e.preventDefault();
					for ( i = 0; i < menuItem.parentNode.children.length; ++ i ) {
						if ( menuItem === menuItem.parentNode.children[i] ) {
							continue;
						}
						menuItem.parentNode.children[i].classList.remove( 'focus' );
					}
					menuItem.classList.add( 'focus' );
				} else {
					menuItem.classList.remove( 'focus' );
				}
			};

			for ( i = 0; i < parentLink.length; ++ i ) {
				parentLink[i].addEventListener( 'touchstart', touchStartFn, false );
			}
		}
	}( container ) );
} )();

/**
 * Fixes menu out of viewport
 */
( function ( $ ) {
	var handlerIn, handlerOut,
	    container = document.getElementById( 'site-navigation' );

	// For touchscreen and mouse enter
	handlerIn = function () {
		if ( $( this ).children( 'ul.sub-menu' ).length > 0 ) {

			// Get document width
			var docWidth = $( document ).width();

			// Get window width
			var windowWidth = $( window ).width();

			// Condition where menu item goes out of viewport
			if ( docWidth > windowWidth ) {
				$( this ).children( ' ul.sub-menu' ).addClass( 'spacious-menu--left' );
			}
		}
	};

	// For mouse leave
	handlerOut = function () {
		$( this ).children( ' ul.sub-menu' ).removeClass( 'spacious-menu--left' );
	};

	// Desktop
	$( '.main-navigation  .menu-item-has-children, .main-navigation .page_item_has_children' ).hover( handlerIn, handlerOut );


	// Touch screen
	( function ( container ) {
		var i,
		    parentLink = container.querySelectorAll( '.main-navigation  .menu-item-has-children, .main-navigation .page_item_has_children' );

		if ( 'ontouchstart' in window ) {

			for ( i = 0; i < parentLink.length; ++ i ) {
				parentLink[i].addEventListener( 'touchstart', handlerIn, false );
			}
		}
	} )( container );

} )( jQuery );

/**
 * Keep menu items on one line.
 */
(
	function () {

		jQuery( document ).ready( function () {
			// Get required elements.
			var mainWrapper            = document.querySelector( '#header-text-nav-container .inner-wrap' ),
			    branding               = document.getElementById( 'header-left-section' ),
			    headerAction           = document.querySelector( '.header-action' ),
			    navigation             = document.getElementById( 'site-navigation' ),
			    mainWidth              = mainWrapper.offsetWidth,
			    brandWidth             = branding.offsetWidth,
			    navWidth               = navigation.offsetWidth,
			    headerActionWidth      = headerAction.offsetWidth,
			    isExtra                = ( brandWidth + navWidth + headerActionWidth ) > mainWidth,
			    more                   = navigation.getElementsByClassName( 'tg-menu-extras-wrap' )[0],
			    headerDisplayTypeThree = document.getElementById( 'spacious-header-display-three' ),
			    headerDisplayTypeFour  = document.getElementById( 'spacious-header-display-four' );

			// Check for header style 3 and 4.
			if ( ( headerDisplayTypeFour !== null ) || ( headerDisplayTypeThree !== null ) ) {
				isExtra = ( navWidth + headerActionWidth ) >= mainWidth;
			}

			// Return if no excess menu items.
			if ( ! navigation.classList.contains( 'tg-extra-menus' ) ) {
				return;
			}

			function Dimension( el ) {
				var elWidth;
				if ( document.all ) {// IE.
					elWidth = el.currentStyle.width + parseInt( el.currentStyle.marginLeft, 10 ) + parseInt( el.currentStyle.marginRight, 10 ) + parseInt( el.currentStyle.paddingLeft, 10 ) + parseInt( el.currentStyle.paddingRight, 10 );
				} else {
					elWidth = parseInt( document.defaultView.getComputedStyle( el, '' ).getPropertyValue( 'width' ) ) + parseInt( document.defaultView.getComputedStyle( el, '' ).getPropertyValue( 'margin-left' ) ) + parseInt( document.defaultView.getComputedStyle( el, '' ).getPropertyValue( 'margin-right' ) );
				}

				return elWidth;
			}

			// If menu excesses.
			if ( ! isExtra ) {
				more.parentNode.removeChild( more );
			} else {
				var widthToBe, headerAction, buttons, headerActionWidth, buttonWidth, moreWidth;

				widthToBe = mainWidth - brandWidth - headerActionWidth;

				// Check for header style 3 and 4.
				if ( ( headerDisplayTypeFour !== null ) || ( headerDisplayTypeThree !== null ) ) {
					widthToBe = mainWidth - headerActionWidth;
				}

				headerAction      = navigation.getElementsByClassName( 'header-action' )[0];
				buttons           = navigation.getElementsByClassName( 'tg-header-button-wrap' );
				buttonWidth       = buttons[0] ? Dimension( buttons[0] ) : 0;
				buttonWidth += buttons[1] ? Dimension( buttons[1] ) : 0;
				moreWidth         = more ? Dimension( more ) : 0;
				newNavWidth       = widthToBe - ( buttonWidth + moreWidth );

				navigation.style.visibility = 'none';
				navigation.style.width      = newNavWidth + 'px';

				// Returns first children of a node.
				function getChildNodes( node ) {
					var children = new Array();

					if ( typeof node !== 'undefined' ) {
						for ( var child in node.childNodes ) {
							if ( 1 === node.childNodes[child].nodeType ) {
								children.push( node.childNodes[child] );
							}
						}
					}

					return children;
				}

				var navUl = navigation.getElementsByClassName( 'nav-menu' )[0],
				    navLi = getChildNodes( navUl ); // Get lis.

				function offset( el ) {
					var rect       = el.getBoundingClientRect(),
					    scrollLeft = window.pageXOffset || document.documentElement.scrollLeft,
					    scrollTop  = window.pageYOffset || document.documentElement.scrollTop;

					return { top : rect.top + scrollTop, left : rect.left + scrollLeft }
				}

				var extraLi = [];

				for ( var liCount = 0; liCount < navLi.length; liCount ++ ) {
					var initialPos, li, posTop;

					li     = navLi[liCount];
					posTop = offset( li ).top;

					if ( 0 === liCount ) {
						initialPos = posTop;
					}

					if ( posTop > initialPos ) {
						if ( ! li.classList.contains( 'header-action' ) && ! li.classList.contains( 'tg-menu-extras-wrap' ) && ! li.classList.contains( 'tg-header-button-wrap' ) ) {
							extraLi.push( li );
						}
					}
				}

				var newNavWidth = newNavWidth + ( buttonWidth + moreWidth ) - 30,
				    extraWrap   = document.getElementById( 'tg-menu-extras' );

				// Check for header style 3 and 4.
				if ( ( headerDisplayTypeFour !== null ) || ( headerDisplayTypeThree !== null ) ) {
					newNavWidth = navWidth - headerActionWidth;
				}

				navigation.style.width = newNavWidth + 'px';

				if ( null !== extraWrap ) {
					extraLi.forEach( function ( item, index, arr ) {
						extraWrap.appendChild( item );
					} );
				}

			}
		} );

	}()
);
