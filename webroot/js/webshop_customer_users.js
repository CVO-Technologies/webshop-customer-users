$(function () {
	$('#CustomerType').closest('form').addClass('individual');
	var changeToIndividual = function () {
		$('#CustomerName').attr('disabled', true);
	};
	var changeToCompany = function () {
		$('#CustomerName').attr('disabled', false);
	};

	$(document).on('change', '#UserName', function () {
		if (!$(this).closest('form').hasClass('individual')) {
			return;
		}

		$('#CustomerName').val($(this).val());
	});

	$(document).on('change', '#CustomerType', function () {
		switch ($(this).val()) {
			case 'individual':
				$(this).closest('form').addClass('individual');
				$(this).closest('form').removeClass('company');

				changeToIndividual();
				break;
			case 'company':
				$(this).closest('form').addClass('company');
				$(this).closest('form').removeClass('individual');

				changeToCompany();
				break;
		}
	});

	changeToIndividual();
});
