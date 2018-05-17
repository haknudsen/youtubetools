function Html( obj ) {
				if ( obj.value == 'Html Code' ) {
					document.getElementById( "textHtml" ).value = document.getElementById( "lblSpin" ).innerHTML;
					document.getElementById( "textHtml" ).style.display = "block";
					document.getElementById( "lblSpin" ).style.display = "none";
					document.getElementById( "inpHtml" ).value = "Preview";
				} else {
					document.getElementById( "textHtml" ).style.display = "none";
					document.getElementById( "lblSpin" ).style.display = "block";
					document.getElementById( "inpHtml" ).value = "Html Code";
				}
			}

			function Spin() {
				var content = document.getElementById( "textSpin" ).value.trim();
				if ( content == "" ) {
					alert( "Please input spyntax content!" );
				} else if ( content.split( "{" ).length != content.split( "}" ).length ) {
					alert( "Incorrect spyntax in content! Please re-check it!" );
				} else {
					if ( document.getElementById( "chkNewLine" ).checked ) {
						var regX = /\n/gi;
						content = content.replace( regX, "<br />" );
					}
					document.getElementById( "lblSpin" ).innerHTML = GetSpinContent( content );
					document.getElementById( "inpHtml" ).style.display = "";
					if ( document.getElementById( "inpHtml" ).value == "Preview" )
						document.getElementById( "textHtml" ).value = document.getElementById( "lblSpin" ).innerHTML;
				}
			}

			function GetSpinContent( text ) {
				var result = text;
				var reg = new RegExp( /{([^{}]*)\}/i );
				while ( matches = reg.exec( result ) ) {
					var array = new Array();
					array = matches[ 1 ].split( '|' );
					result = result.replace( matches[ 0 ], array[ Math.floor( Math.random() * array.length ) ] );
				}

				reg = new RegExp( /\{\{([\s\S]*?)\}\}/i );
				while ( match = reg.exec( result ) ) {
					var array = new Array();
					array = match[ 1 ].split( '||' );
					result = result.replace( match[ 0 ], array[ Math.floor( Math.random() * array.length ) ] );
				}
				return result;
			}