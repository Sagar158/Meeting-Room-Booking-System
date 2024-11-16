function refreshSelectBox()
{
    $('.ajax-endpoint').each(function() {
        var $this = $(this);
        var endpoint = $this.data('endpoint');
        var placeholder = $this.data('placeholder');
        var field1 = $this.data('field1-id');
        var field2 = $this.data('field2-id');
        $this.select2({
            ajax: {
                url: endpoint,
                dataType: 'json',

                data: function(params) {
                    var data = {
                        search: params.term,
                        field1: field1,
                        field2: field2
                    };
                    return data;
                },
                processResults: function(response) {
                    return {
                        results: response.data.map(function(item) {
                            return { id: item.id, text: item.name };
                        })
                    };
                }
            },
            minimumInputLength: 0,
            placeholder: placeholder,
        });
    });
}
function destroySelect2($this, placeholder)
{
    var field1 = $this.attr('data-field1-id');
    var field2 = $this.attr('data-field2-id');
    $this.select2('destroy').select2({
            ajax: {
                url: $this.data('endpoint'),
                dataType: 'json',
                data: function(params) {
                    return {
                        search: params.term,
                        field1: field1,
                        field2: field2
                    };
                },
                processResults: function(response) {
                    return {
                        results: response.data.map(function(item) {
                            return { id: item.id, text: item.name };
                        })
                    };
                    }
            },
            placeholder: placeholder,
            allowClear: true
    });
}


function notification(title, text, icon)
{
    Swal.fire({
        title: title,
        text: text,
        icon: icon
     });
}
