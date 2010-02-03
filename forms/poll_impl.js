/**
 * onBeforeSave
 *
 */
function onBeforeSave()
{
	var startDate = this.fields["startpublicationdate"];
	var endDate = this.fields["endpublicationdate"];
	if (startDate.value != "" && endDate.value != "" && startDate.value > endDate.value)
	{
		alert('&amp;modules.poll.messages.error.EndDateMustBeAfterStartDate;');
		return false;
	}
	return true;
}