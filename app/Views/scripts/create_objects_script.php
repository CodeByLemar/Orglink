<script>
    	function isUpperJaw(toothNumber) {
		return toothNumber >= 11 && toothNumber <= 28;
	}

	function getSiteData(toothNumber) {
		const isUpperJaw = toothNumber >= 11 && toothNumber <= 28;
		// Default data for the lower jaw
		const defaultData = { db: 0, b: 0, mb: 0, dl: 0, l: 0, ml: 0 };
		// Additional data for the upper jaw
		const upperJawData = { dp: 0, p: 0, mp: 0 };
		// Combines the standard data with the additional data for the upper jaw, if applicable
		return isUpperJaw ? {...defaultData, ...upperJawData} : defaultData;
	}
		
	function getFurcationData(toothNumber) {
		const furcationData = {
			18: { b: 0, mp: 0, dp: 0 },
			17: { b: 0, mp: 0, dp: 0 },
			16: { b: 0, mp: 0, dp: 0 },
			26: { b: 0, mp: 0, dp: 0 },
			27: { b: 0, mp: 0, dp: 0 },
			28: { b: 0, mp: 0, dp: 0 },
			14: { mp: 0, dp: 0 },
			24: { mp: 0, dp: 0 },
			48: { b: 0, l: 0 },
			47: { b: 0, l: 0 },
			46: { b: 0, l: 0 },
			36: { b: 0, l: 0 },
			37: { b: 0, l: 0 },
			38: { b: 0, l: 0 }
		};
		return furcationData[toothNumber];
	}

	function Tooth(toothNumber, present = true, mobility = 0, implant = false, site = {}, note = '') {
		this.present = present;
		this.mobility = mobility;
		this.implant = implant;
    	this.furcation = getFurcationData(toothNumber) || null; // Uses specific data or 'null'

		this.note = note;

		// Coordinates
		this.coordinates = {};
		
		// Determine whether the tooth belongs to the upper or lower jaw
		if ((toothNumber >= 11 && toothNumber <= 18) || (toothNumber >= 21 && toothNumber <= 28)) {
			this.jaw = 'upper';
		} else if ((toothNumber >= 31 && toothNumber <= 38) || (toothNumber >= 41 && toothNumber <= 48)) {
			this.jaw = 'lower';
		} else {
			this.jaw = 'unknown'; // For invalid tooth numbers
		}

		// Assignment of the locations based on the tooth number
        // Uppdar jaw
        // db: distobuccal, b: buccal, mb: mesiobuccal, dp: distopalatal, p: palatal, mp: mesiopalatal
        // Lower jaw
        // db: distobuccal, b: buccal, mb: mesiobuccal, dl: distolungual, l: lingual, ml: mesiolingual
        
		if (isUpperJaw(toothNumber)) {
			// Upper jaw
			this.pi = { db: site.db || 0, b: site.b || 0, mb: site.mb || 0, dp: site.dp || 0, p: site.p || 0, mp: site.mp || 0 };
			this.bop = { db: site.db || 0, b: site.b || 0, mb: site.mb || 0, dp: site.dp || 0, p: site.p || 0, mp: site.mp || 0 };
			this.pd = { db: site.db || 0, b: site.b || 0, mb: site.mb || 0, dp: site.dp || 0, p: site.p || 0, mp: site.mp || 0 };
			this.gm = { db: site.db || 0, b: site.b || 0, mb: site.mb || 0, dp: site.dp || 0, p: site.p || 0, mp: site.mp || 0 };
			this.al = { db: site.db || 0, b: site.b || 0, mb: site.mb || 0, dp: site.dp || 0, p: site.p || 0, mp: site.mp || 0 };
		} else {
			// Lower jaw
			this.pi = { db: site.db || 0, b: site.b || 0, mb: site.mb || 0, dl: site.dl || 0, l: site.l || 0, ml: site.ml || 0 };
			this.bop = { db: site.db || 0, b: site.b || 0, mb: site.mb || 0, dl: site.dl || 0, l: site.l || 0, ml: site.ml || 0 };
			this.pd = { db: site.db || 0, b: site.b || 0, mb: site.mb || 0, dl: site.dl || 0, l: site.l || 0, ml: site.ml || 0 };
			this.gm = { db: site.db || 0, b: site.b || 0, mb: site.mb || 0, dl: site.dl || 0, l: site.l || 0, ml: site.ml || 0 };
			this.al = { db: site.db || 0, b: site.b || 0, mb: site.mb || 0, dl: site.dl || 0, l: site.l || 0, ml: site.ml || 0 };
		}

		// Initialisation of the area variables as objects with bop_pos and bop_neg
		const areas = [
			'distobuccalArea', 'mesiobuccalArea', 
			'distopalatalArea', 'mesiopalatalArea',
			'distalArea', 'mesialArea', 'totalArea'
		];
		
		areas.forEach(flaeche => {
			this[flaeche] = { bop_pos: 0, bop_neg: 0 };
		});
		
		this.initializeAreas = function() {
			areas.forEach(flaeche => {
				this[flaeche].bop_pos = 0;
				this[flaeche].bop_neg = 0;
			});
		};

        // Method for calculating the areas
		this.calculateAndStoreAreas = function() {
			// Heights for buccal trapezoids
			var h_buccal = Math.abs(this.coordinates.x_b - this.coordinates.x_db);

			// Side lengths for buccal trapezoids
			var a1_buccal = Math.abs(this.coordinates.y_al_db - this.coordinates.y_gm_db);
			var b1_buccal = Math.abs(this.coordinates.y_al_b - this.coordinates.y_gm_b);
			var a2_buccal = b1_buccal;
			var b2_buccal = Math.abs(this.coordinates.y_al_mb - this.coordinates.y_gm_mb);

			// Area calculation for buccal trapezoids
			var distobuccalArea = calculateArea(a1_buccal, b1_buccal, h_buccal);
			var mesiobuccalArea = calculateArea(a2_buccal, b2_buccal, h_buccal);

			// Heights for palatal trapezoids
			var h_palatal = Math.abs(this.coordinates.x_p - this.coordinates.x_dp);

			// Side lengths for palatal trapezoids
			var a1_palatal = Math.abs(this.coordinates.y_al_dp - this.coordinates.y_gm_dp);
			var b1_palatal = Math.abs(this.coordinates.y_al_p - this.coordinates.y_gm_p);
			var a2_palatal = b1_palatal;
			var b2_palatal = Math.abs(this.coordinates.y_al_mp - this.coordinates.y_gm_mp);

			// Area calculation for palatal trapezoids
			var distopalatalArea = calculateArea(a1_palatal, b1_palatal, h_palatal);
			var mesiopalatalArea = calculateArea(a2_palatal, b2_palatal, h_palatal);

			// Height for mesial and distal trapezoids
			var h_mesial_distal = 5 * 6.5; // 5mm resp. 1mm = 6.5 units

			// Calculation of the side lengths for the mesial trapezoid
			// Area calculation for mesial and distal trapezoids
			var distalArea = calculateArea(a1_buccal, a1_palatal, h_mesial_distal);
			var mesialArea = calculateArea(b2_buccal, b2_palatal, h_mesial_distal);

			// total area
			var totalArea = distobuccalArea + mesiobuccalArea + distopalatalArea + mesiopalatalArea + distalArea + mesialArea;
			
			this.areas = { totalArea, distobuccalArea, mesiobuccalArea, distopalatalArea, mesiopalatalArea, distalArea, mesialArea };
		}
		
		// Method for saving the coordinates
		this.storeCoordinates = function(x_db, x_mb, x_dp, x_mp, x_b, x_p, y_gm_db, y_gm_b, y_gm_mb, y_pd_db, y_pd_b, y_pd_mb, y_gm_dp, y_gm_p, y_gm_mp, y_pd_dp, y_pd_p, y_pd_mp, y_al_db, y_al_b, y_al_mb, y_al_dp, y_al_p, y_al_mp) {
			this.coordinates = { x_db, x_mb, x_dp, x_mp, x_b, x_p, y_gm_db, y_gm_b, y_gm_mb, y_pd_db, y_pd_b, y_pd_mb, y_gm_dp, y_gm_p, y_gm_mp, y_pd_dp, y_pd_p, y_pd_mp, y_al_db, y_al_b, y_al_mb, y_al_dp, y_al_p, y_al_mp };
			// Call the method for calculating and saving the areas
			this.calculateAndStoreAreas();
		};
	}

    // List of valid tooth numbers
	var validTeeth = [11, 12, 13, 14, 15, 16, 17, 18, 
					  21, 22, 23, 24, 25, 26, 27, 28,
					  31, 32, 33, 34, 35, 36, 37, 38,
					  41, 42, 43, 44, 45, 46, 47, 48];

	// Objects to store tooth data
    // names can change to teeth() and superimposedTeeth()
	var pockets = {};
	var superimposedPockets = {};

	// Initialisation of the objects
	validTeeth.forEach(function(toothNumber) {
		const site = getSiteData(toothNumber);
		pockets[toothNumber] = new Tooth(toothNumber, true, 0, false, site);
		superimposedPockets[toothNumber] = new Tooth(toothNumber, true, false, site);
	});
	
	function calculateArea(a, b, h) {
		return ((a + b) / 2) * h;
	}
	
	//console.log("Object pockets", pockets);
	//console.log("Object superimposedPockets", superimposedPockets);
</script>