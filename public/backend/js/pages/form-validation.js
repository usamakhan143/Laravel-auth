//[form-validation element Javascript]

//Project:	Unique Admin - Responsive Admin Template

	! function(window, document, $) {
        "use strict";
			$("input,select,textarea").not("[type=submit]").jqBootstrapValidation();
		}(window, document, jQuery);