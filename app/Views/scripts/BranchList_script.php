<script>
    
    $(document).ready(function(){
        
        getbranches();
 
        $('#submit_branch').on('click',function(){ 
            Branch_Code     = $('#Branch_Code').val();
            Branch_Desc     = $('#Branch_Desc').val(); 

            $.ajax({
                type: "POST",
                url:"<?php echo base_url('Procedures/addbranch');?>",
                data: 
                {
                    Branch_Code:Branch_Code,
                    Branch_Desc:Branch_Desc 
                },
                success:function(data){  
                    $("input[type=text], input[type=time],input[type=date],input[type=number],select").val("");
                    $("#add_branch_modal").modal('hide');
                    // alert('Successfully Submitted');
                    
                    getbranches();
                }
            });

        });
    });
    function nulltoblank(x){
        if(x==null){
            x= '';
        }
        return x;
    }

    function nulltozero(x){
        if(x==null){
            x= 0;
        }
        return x;
    }

    function number_format(number, decimals, dec_point, thousands_sep) {
        // Strip all characters but numerical ones.
        number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function (n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }

    function branch_btns(){
        $('.deletebranch_btn').on('click',function(){
            branch = $(this).attr("data-branch");
            desc = $(this).attr("data-desc");
            if (confirm('Are you sure you want to delete '+desc+'?')) {
                $.ajax({
                    type: "POST",
                    url:"<?php echo base_url('Procedures/deletebranch');?>", 
                    data: 
                    {
                        branch:branch, 
                    },
                    success:function(data){
                        alert("Successfully Deleted");
                        getbranches();
                    }
                });
            } 
        });

        $('.restorebranch_btn').on('click',function(){
            branch = $(this).attr("data-branch");
            desc = $(this).attr("data-desc");
            if (confirm('Are you sure you want to restore '+desc+'?')) {
                $.ajax({
                    type: "POST",
                    url:"<?php echo base_url('Procedures/restorebranch');?>", 
                    data: 
                    {
                        branch:branch, 
                    },
                    success:function(data){
                        alert("Successfully Restored");
                        getbranches();
                    }
                });
            } 
        }); 
    }

    function getbranches(){ 
        $.ajax({
            type: "POST",
            url:"<?php echo base_url('Procedures/getbranches');?>", 
            success:function(data){ 
                data = JSON.parse(data);
                $('#branch_tbl tbody').empty();
                
                data.forEach(row => {
                    if(row.BL_Status=='Active'){
                        status_action = `<a data-branch="${row.BL_Branch_Code}" data-desc="${row.BL_Branch_Desc}" href="#!" class="deletebranch_btn btn btn-sm btn-danger"><i class="fa-solid fa-xmark"></i></a>`;
                        status = `<span class="badge bg-success">${row.BL_Status}</span>`;
                    }else{
                        status_action = `<a data-branch="${row.BL_Branch_Code}" data-desc="${row.BL_Branch_Desc}" href="#!" class="restorebranch_btn btn btn-sm btn-primary"><i class="fa-solid fa-rotate-left"></i></a>`;
                        status = `<span class="badge bg-danger">${row.BL_Status}</span>`;
                    }
                    tr = `  <tr>
                                <td class="text-center">${row.BL_Branch_Code}</td>
                                <td class="text-center">${row.BL_Branch_Desc}</td> 
                                <td class="text-center">${status}</td>
                                <td class="text-center">${status_action}</td>
                            </tr>`;
                    $('#branch_tbl tbody').append(tr);
                });
                branch_btns();
            }
        });
    } 
</script>