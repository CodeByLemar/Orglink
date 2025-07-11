<link rel="stylesheet" href="<?php echo base_url('assets/custom/apexcharts-bundle/dist/apexcharts.css')?>">

<script src="<?php echo base_url('assets/custom/apexcharts-bundle/dist/apexcharts.min.js');?>"></script>
<script src="<?php echo base_url('assets/custom/tinymce/js/tinymce/tinymce.min.js');?>"></script>
<script>
    $(document).ready(function(){ 
        
        var from = $('#from').val();
        var to = $('#to').val();
        getprocsmonth(from,to);
        getunaccommonth(from,to);
        getdentistprocs(from,to);
        getproccountmonth(from,to); 
        
        tinymce.init({
            selector: '#notes',  // Change this to the ID of your textarea
            // width: 600,
            height: 200,
            plugins: [
                'advlist', 'autolink', 'link', 'image', 'lists', 'charmap', 'preview', 'anchor', 'pagebreak',
                'searchreplace', 'wordcount', 'visualblocks', 'code', 'fullscreen', 'insertdatetime', 'media',
                'table', 'emoticons', 'help'
            ],
            toolbar: 'fontsize | bold italic | alignleft aligncenter alignright alignjustify | ' +
                'bullist numlist outdent indent | link image | fullscreen | ' +
                'forecolor backcolor emoticons | help'
                ,
            menu: {
                favs: { title: 'My Favorites', items: 'code visualaid | searchreplace | emoticons' }
            },
            menubar: 'favs file edit view insert format tools table help',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
        });


        
        $('#notes').on('input',function(){ 
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

    function getprocsmonth(from,to){
        $.ajax({
            type: "POST",
            url:"<?php echo base_url('Dashboard/getprocsmonth');?>", 
            data: 
            {
                from:from,
                to:to 
            },
            success:function(data){ 
                data = JSON.parse(data); 
                data.forEach(row => { 
                    $('#proccount').html(row.proccount);
                });
            }
        });
    }

    function getunaccommonth(from,to){
        $.ajax({
            type: "POST",
            url:"<?php echo base_url('Dashboard/getunaccommonth');?>", 
            data: 
            {
                from:from,
                to:to 
            },
            success:function(data){ 
                data = JSON.parse(data); 
                data.forEach(row => { 
                    $('#unaccomcount').html(row.unaccomcount);
                });
            }
        });
    }

    function getdentistprocs(from,to){
        $.ajax({
            type: "POST",
            url:"<?php echo base_url('Dashboard/getdentistprocs');?>", 
            data: 
            {
                from:from,
                to:to 
            },
            success:function(data){ 
                data = JSON.parse(data); 
                 
                const processedData = data.map(item => ({
                    x: item.x,
                    y: Number(item.y), // Convert to number
                    color: item.color
                }));  

                const colors = processedData.map(item => {
                    
                    return item.color; // Color for values less than or equal to 2
                }); 
                console.log(colors)
                options = {
                    chart: {
                        type: 'bar'
                    },
                    plotOptions: {
                        bar: {
                            distributed: true,  
                            horizontal: true
                        }
                    },
                    series: [{
                        data: data
                    }],
                    fill: {
                        colors: colors
                    },
                    legend: {
                        show: false // Hide the legend
                    }, 
                    xaxis: {
                        title: {
                            text: 'Dentists'
                        },tickAmount: 1
                    },
                    yaxis: {
                        title: {
                            text: 'Appointment/s'
                        }
                    } 
                    
                }
                var dentist_bar = new ApexCharts(document.querySelector("#dentist_bar"), options);
                dentist_bar.render();
            }
        });
    }

    function getproccountmonth(from,to){
        $.ajax({
            type: "POST",
            url:"<?php echo base_url('Dashboard/getproccountmonth');?>", 
            data: 
            {
                from:from,
                to:to 
            },
            success:function(data){ 
                data = JSON.parse(data);
                var proc_value  = [];
                var proc_labels = [];
                var proc_color  = []; 
                data.forEach(row => { 
                    proc_value.push(parseInt(row.CAPL_Procedure));
                    proc_labels.push(row.SPL_SubProcedure_Desc); 
                });
                console.log(proc_value)
                console.log([44, 55 ])
                var options = {
                    chart: {
                        width: 400,
                        type: 'pie',
                        height: 450
                    },
                    series: proc_value,
                    labels: proc_labels,
                    // title: {
                    //     text: ' ',
                    //     align: 'center'
                    // },
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                width: 200
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }]
                };

                var procedures_pie = new ApexCharts(document.querySelector("#procedures_pie"), options);
                procedures_pie.render();
            }
        });
    }
</script>