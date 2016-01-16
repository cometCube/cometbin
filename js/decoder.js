/* Spam-me-not.js - JavaScript source of Spam-me-not. */

/* Encode email addresses to make it harder for Spammers to harvest them. */

/* Copyright (c) 2003 by Andreas Neudecker */
/* Licensed under the GNU General Public License (GPL), see http://www.gnu.org/copyleft/ */
/* Last changes: 2003-10-01 by Andreas Neudecker */

/* This is where the real encoding is done */

		function EmailText(address)
		{
				coded = address
				cipher = "aZbYcXdWeVfUgThSiRjQkPlOmNnMoLpKqJrIsHtGuFvEwDxCyBzA1234567890"
				shift=coded.length
				link=""
				for (i=0; i<shift; i++){
					if (cipher.indexOf(coded.charAt(i))==-1){
						ltr=coded.charAt(i)
						link+=(ltr)
					}
					else {
						ltr = (cipher.indexOf(coded.charAt(i))-shift+cipher.length) % cipher.length
						link+=(cipher.charAt(ltr))
					}
				}
				//document.write("<a href='mailto:"+link+"'>Email</a>")
				document.write(link);
		}

		function EmailLink(address,displaytext)
		{
				coded = address
				cipher = "aZbYcXdWeVfUgThSiRjQkPlOmNnMoLpKqJrIsHtGuFvEwDxCyBzA1234567890"
				shift=coded.length
				link=""
				for (i=0; i<shift; i++){
					if (cipher.indexOf(coded.charAt(i))==-1){
						ltr=coded.charAt(i)
						link+=(ltr)
					}
					else {
						ltr = (cipher.indexOf(coded.charAt(i))-shift+cipher.length) % cipher.length
						link+=(cipher.charAt(ltr))
					}
				}
				//document.write("<a href='mailto:"+link+"'>Email</a>")

				if (displaytext=="")
				{
					document.write("<a href='mailto:" + link + "'>" + link + "</a>");
				}
					else
				{
					document.write("<a href='mailto:" + link + "'>" + displaytext + "</a>");
				}
		}
