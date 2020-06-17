// $( function() {

	var topics = ['privacy', 'data', 'feminism', 'abuse', 'social networks', 'loss', 'AI', 'politics'],
		projects = [],
		$topicLinks = $( '[data-topic-link' ),
		$projects = $( '#projects article' ),
		$timelines = $( '#timelines' ),
		$svg = $( '#bracecords' ),
		$ranges,
		DateTime = luxon.DateTime,
		timelineStart = Infinity,
		timelineEnd = -Infinity

	var prepTheTopics = function() {
		
		var thisTopic,
			thisTimelineEl

		$.each(topics, function( index, value ) {
			thisTimelineEl = $( '<div class="timelineTopic" />' )
			thisTimelineEl.append( `<div class="timelineLabel">${value}</div>` )
			$timelines.append( thisTimelineEl )
		} )

	}

	var prepTheProjects = function() {
		$projects.each( function() {
			var $this = $( this ),
				thisStart = DateTime.fromISO( $this.data( 'project-start-date' ) ),
				thisEnd = DateTime.fromISO( $this.data( 'project-end-date' ) )
	
				timelineStart = Math.min( timelineStart, thisStart)
				timelineEnd = Math.max( timelineEnd, thisEnd)
	
			projects.push( {
				'start': thisStart,
				'end': thisEnd,
				'topics': $( this ).data( 'project-topics' ).split( ',' ),
				'$el': $this
			} )
		})	
	}

	var prepTheTimeRanges = function() {
		for( var i = 0; i < projects.length; i++ ) {
			var $timelineRange = $( '<div class="timelineRange" />' )
			$timelineRange.css( {
				'top': 100 - timeToPercent( projects[i].end.ts ) + '%',
				'bottom': timeToPercent( projects[i].start.ts ) + '%'
			} )
			var theseTopics = projects[i].topics
			for( var j = 0; j < theseTopics.length; j++ ) {
				$( '<div class="topic" />' ).addClass( theseTopics[j] ).appendTo( $timelineRange )
			}
			$timelineRange.appendTo( '#timelines' )
		}

		function timeToPercent( value, r1, r2 ) { 
			var r1 = r1 || [timelineStart, timelineEnd],
			r2 = r2 || [0, 100]
			return ( value - r1[ 0 ] ) * ( r2[ 1 ] - r2[ 0 ] ) / ( r1[ 1 ] - r1[ 0 ] ) + r2[ 0 ]
		}
	}

	var addPaths = function( braceTop, braceBottom, targetY, width ) {

		const height = braceBottom - braceTop,
			  xTop = 0,
			  yTop = braceTop,
			  xBottom = 0,
			  yBottom = braceBottom,
			  xMiddle = width * 0.25,
			  yMiddle = (height * 0.5) + braceTop,
			  xEnd = width,
			  yEnd = targetY,
	  
			  xTopCp = width * 0.125,
			  yTopCp = yTop,
			  xBottomCp = xTopCp,
			  yBottomCp = yBottom,
			  xMiddleCpLeft = xTopCp,
			  yMiddleCpLeft = yMiddle,
			  xMiddleCpRight = width * 0.625,
			  yMiddleCpRight = yMiddle,
			  xEndCp = xMiddleCpRight,
			  yEndCp = yEnd,
		
			  pathStr = `<path d="M ${xTop} ${yTop} C ${xTopCp} ${yTopCp}, ${xMiddleCpLeft} ${yMiddleCpLeft}, ${xMiddle} ${yMiddle}" stroke="#000" fill="transparent" />
	  					 <path d="M ${xBottom} ${yBottom} C ${xBottomCp} ${yBottomCp}, ${xMiddleCpLeft} ${yMiddleCpLeft}, ${xMiddle} ${yMiddle}" stroke="#000" fill="transparent" />
	  					 <path d="M ${xMiddle} ${yMiddle} C ${xMiddleCpRight} ${yMiddleCpRight}, ${xEndCp} ${yEndCp}, ${xEnd} ${yEnd}" stroke="#000" fill="transparent" />`
	  
		$svg[0].innerHTML += pathStr
	  
	}

	var drawTheCoords = function() {

		var $this,
			top,
			bottom,
			projectY,
			width = $svg.width(),
			scroll = $( window ).scrollTop()

		$svg.empty()

		$ranges.each( function( index ) {
			$this = $( this )
			if( scroll > $svg.position().top - 20 ) {
				top = $this.position().top + ( $( window ).scrollTop() - $svg.position().top ) + 20
			} else {
				top = $this.position().top
			}
			
			bottom = top + $this.height()
			projectY = $projects.eq( index ).position().top + 16
			// console.log( $svg.position().top, $( window ).scrollTop() )
			// console.log( top, bottom, projectY, width )
			addPaths( top, bottom, projectY, width )
		} )

	}

	prepTheTopics()
	prepTheProjects()
	prepTheTimeRanges()
	$ranges = $( '.timelineRange' )
	drawTheCoords()
	$(window).scroll( drawTheCoords )
	$(window).resize( drawTheCoords )

	// console.log( topics, projects, timelineStart, timelineEnd )

// } )
