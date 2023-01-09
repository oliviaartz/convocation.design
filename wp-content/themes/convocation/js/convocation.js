$('.filter').each(function() {

	var $filter = $(this),
			$form = $filter.find('form'),
			$formFields = $form.find('.filter__input_text, .filter__select'),
			$textSearch = $formFields.filter('.filter__input_text'),
			$resetButton = $form.find('.filter__input_reset'),
			$resetButtonOriginalValue = $resetButton.val(),
			checkIfFormIsBlank = function() {
				$formFields.each(function() {
					if (this.value !== '') {
						$filter.addClass('filter--filtering')
						return false
					}
					$filter.removeClass('filter--filtering')
				})
			}
	
	$textSearch.on('focus', function() {
		$filter.addClass('filter--text-focus')
		$resetButton.val('X')
	})
	
	$textSearch.on('blur', function() {
		$filter.removeClass('filter--text-focus')
		$resetButton.val($resetButtonOriginalValue)
	})
	
	$form.on('change', checkIfFormIsBlank)
	
	$resetButton.on('click', function(e) {
		e.preventDefault()
		$form.get(0).reset()
		checkIfFormIsBlank()
	})

})

