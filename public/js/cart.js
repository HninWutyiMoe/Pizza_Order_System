$(document).ready(function() {
    $('.btn-plus').click(function() {
        $parentNode = $(this).parents("tr");
        $price = Number($parentNode.find('#price').text().replace("mmk",""));
        // string ko number change
        $qty = Number($parentNode.find('#qty').val());
        //  OR
        // $qty = ($parentNode.find('#qty').val()*1);

        // console.log($price)
        // console.log($qty)

        $total = $price * $qty;

        $parentNode.find('#total').html($total+" mmk");

        summaryCalculation();
    })

    $('.btn-minus').click(function() {
        $parentNode = $(this).parents("tr");
        $price = Number($parentNode.find('#price').text().replace("mmk",""));

        $qty = Number($parentNode.find('#qty').val());

        $total = $price * $qty;

        $parentNode.find('#total').html(`${$total} mmk`);

        summaryCalculation();
    })

    function summaryCalculation(){
        $totalPrice = 0;
        $('#dataTable tbody tr').each(function(index,row){
            $totalPrice += Number($(row).find('#total').text().replace("mmk",""));
        });

        $("#subTotalPrice").html(`${$totalPrice} mmk`);
        $("#finalPrice").html(`${$totalPrice+3000} mmk`);
    }
})
