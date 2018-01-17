

<script type="text/javascript">

    $(document).ready(function() {
    
        $("#add_lease_click").click(function(event) {
            event.preventDefault();
            var i = $('table.add-lease tr').length;

            var add_row = function(){
                html = '<tr>';
                html += '<td><input class="case" type="checkbox"/></td>';
                html += '<td><input type="text" data-type="productCode" name="data['+i+'][product_id]" id="itemNo_'+i+'" class="form-control autocomplete_txt" autocomplete="off"></td>';
                html += '<td><input type="text" data-type="productName" name="data['+i+'][product_name]" id="itemName_'+i+'" class="form-control autocomplete_txt" autocomplete="off"></td>';
                html += '<td><input type="text" name="data['+i+'][price]" id="price_'+i+'" class="form-control changesNo" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>';
                html += '<td><input type="text" name="data['+i+'][quantity]" id="quantity_'+i+'" class="form-control changesNo" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>';
                html += '<td><input type="text" name="data['+i+'][total]" id="total_'+i+'" class="form-control totalLinePrice" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>';
                html += '</tr>';
                $('table.add-lease').append(html);
                i++;
            };
        });
    });

</script>