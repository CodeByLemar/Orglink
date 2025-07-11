<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script>
    $(document).ready(function(){ 
        getclientinfo(); 
        // retrieveperiodontaldata();
        $('.bleed').on('click',function(){
            no = $(this).attr("data-no"); 
            $(this).toggleClass('btn-light btn-danger');
            
            var val = $(this).val(); 
            var val = val === "0" ? "1" : "0"; 
            $(this).val(val);
             
        });
        $('#download-img').on('click',function(){ 
            var calendarEl = document.getElementById('perio_div');
            html2canvas(calendarEl).then(canvas => {
                const link = document.createElement('a');
                link.download =  'Periodontal_Chart.png';
                link.href = canvas.toDataURL('image/png');
                link.click();
            });
        });
        $('.plaque').on('click',function(){
            no = $(this).attr("data-no"); 
            $(this).toggleClass('btn-light btn-primary');

            var val = $(this).val(); 
            var val = val === "0" ? "1" : "0"; 
            $(this).val(val);
        }); 

        $('.furcation').click(function() {
            var button = $(this);
            furval = $(this).val();

            datano      = $(this).attr('data-no'); 
            type    = $(this).attr('data-type'); 

            var currentSVG = button.find('.circle-svg circle').attr('fill'); 
            // buccal-top-1 
            if (currentSVG === "none") { 
                button.html(`
                    <svg class="circle-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 1 40 20">
                        <defs>
                            <linearGradient id="halfShade" x1="0%" y1="0%" x2="100%" y2="0%">
                                <stop offset="50%" style="stop-color: black; stop-opacity: 1;" />
                                <stop offset="50%" style="stop-color: white; stop-opacity: 1;" />
                            </linearGradient>
                        </defs>
                        <circle cx="20" cy="10" r="15" stroke="black" stroke-width="1" fill="url(#halfShade)" />
                    </svg>
                `);
                 
                $('.'+type+'-'+datano).empty();
                $('.'+type+'-'+datano).html(`<i class="bi bi-circle-half"></i>`);
                
                $(this).val(2);

                
            } else if (currentSVG === "url(#halfShade)") {
                // Change to the solid black SVG
                button.html(`
                    <svg class="circle-svg"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 20">
                        <circle cx="20" cy="10" r="15" stroke="black" stroke-width="1" fill="black" />
                    </svg>
                `);

                $('.'+type+'-'+datano).empty();
                $('.'+type+'-'+datano).html(`<i class="bi bi-circle-fill"></i>`);
              
                $(this).val(3);
            } else if (currentSVG === "black") {
                // Change to the blank SVG (no visible elements)
                button.html(`
                    <svg class="circle-svg"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 20">
                        <!-- Blank SVG with no content -->
                    </svg>
                `);
                $('.'+type+'-'+datano).empty();
                $(this).val(0);
                // $('.'+type+'-'+datano).html(`<i class="bi bi-circle-half"></i>`);
            } else {
                // Change back to the default SVG (no fill)
                button.html(`
                    <svg class="circle-svg"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 20">
                        <circle cx="20" cy="10" r="15" stroke="black" stroke-width="1" fill="none" />
                    </svg>
                `);
                $('.'+type+'-'+datano).empty();
                $('.'+type+'-'+datano).html(`<i class="bi bi-circle"></i>`);
                
                $(this).val(1);
            }

            getfurcations();
        });

        $('.implant').click(function(){
            no = $(this).attr('data-no');
            toggle = $(this).val();
 
            $(this).toggleClass('btn-light btn-dark');

            topsrc = $('img.buccal-top[data-no="' + no + '"]').attr('src');
            botsrc = $('img.palatal-bot[data-no="' + no + '"]').attr('src');
            // console.log(toggle)
            if (toggle === '0') {  
                topsrc = topsrc.replace('.png', ''); 
                $('img.buccal-top[data-no="' + no + '"]').attr('src', topsrc+'-implant.png');
 
                botsrc = botsrc.replace('.png', ''); 
                $('img.palatal-bot[data-no="' + no + '"]').attr('src', botsrc+'-implant.png');

                $(this).val("1");
            } else {  
                topsrc = topsrc.replace('-implant', ''); 
                $('img.buccal-top[data-no="' + no + '"]').attr('src', topsrc);

                botsrc = botsrc.replace('-implant', ''); 
                $('img.palatal-bot[data-no="' + no + '"]').attr('src', botsrc);

                $(this).val("0");
                
            }

            getimplants();
        });

        $('.implant-bot').click(function(){
            no = $(this).attr('data-no');
            toggle = $(this).val();
 
            $(this).toggleClass('btn-light btn-dark');

            topsrc = $('img.lingual-top[data-no="' + no + '"]').attr('src');
            botsrc = $('img.buccal-bot[data-no="' + no + '"]').attr('src'); 
            if (toggle === '0') {  
                topsrc = topsrc.replace('.png', ''); 
                $('img.lingual-top[data-no="' + no + '"]').attr('src', topsrc+'-implant.png');
 
                botsrc = botsrc.replace('.png', ''); 
                $('img.buccal-bot[data-no="' + no + '"]').attr('src', botsrc+'-implant.png');

                $(this).val("1");
            } else {  
                topsrc = topsrc.replace('-implant', ''); 
                $('img.lingual-top[data-no="' + no + '"]').attr('src', topsrc);

                botsrc = botsrc.replace('-implant', ''); 
                $('img.buccal-bot[data-no="' + no + '"]').attr('src', botsrc);

                $(this).val("0");
                
            }

            getimplants();
        });

        $('.mobility').on('input',function(){
            var mobility = [];
            $('.mobility').each(function() {
                var no = $(this).data('no'); 
                var val = $(this).val(); 
                mobility[no] = val;     
            }); 
            // console.log(mobility);
        });

        $('.maintoothlabel').on('click',function(){
            var no = $(this).data('no'); 
             
            // $('.cellno-'+no+'').css({
            //     'display': 'none' 
            // });

            const content = $('.cellno-'+no+'');
            if (content.css('visibility') === 'hidden') {
                content.css('visibility', 'visible'); 
                $(this).attr('data-value', '0');
            } else {
                content.css('visibility', 'hidden'); 
                $(this).attr('data-value', '1');
            }
            
        });

        $('#submit_periodontalchart').on('click',function(){  
            teeth           = getteeth(); 
            mobility        = getmobility();
            implants        = getimplants();
            furcations      = getfurcations();

            bleed           = getbleeding();  
            bleed_buccal        = bleed['buccal'];
            bleed_palatal       = bleed['palatal'];
            bleed_lingual       = bleed['lingual'];
            bleed_buccal_bot    = bleed['buccal_bot']; 

            plaque          = getplaque(); 
            plaque_buccal        = plaque['buccal'];
            plaque_palatal       = plaque['palatal'];
            plaque_lingual       = plaque['lingual'];
            plaque_buccal_bot    = plaque['buccal_bot']; 

            gingivalmargin  = getgingivalmargin();
            gingivalmargin_buccal        = gingivalmargin['buccal'];
            gingivalmargin_palatal       = gingivalmargin['palatal'];
            gingivalmargin_lingual       = gingivalmargin['lingual'];
            gingivalmargin_buccal_bot    = gingivalmargin['buccal_bot'];

            probingdepth    = getprobingdepth();
            probingdepth_buccal        = probingdepth['buccal'];
            probingdepth_palatal       = probingdepth['palatal'];
            probingdepth_lingual       = probingdepth['lingual'];
            probingdepth_buccal_bot    = probingdepth['buccal_bot'];

            function convertToString(obj) {
                return Object.entries(obj)
                    .map(([key, value]) => `"${key}": "${value}"`)  
                    .join(', '); 
            }
            
            const newfurcations = Object.entries(furcations)
                .map(([key, value]) => `["${key}": [${convertToString(value)}]]`)   
                .join(', ');

            const newbleed_buccal = Object.entries(bleed_buccal)
                .map(([key, value]) => `["${key}": [${convertToString(value)}]]`)   
                .join(', '); 
            const newbleed_palatal = Object.entries(bleed_palatal)
                .map(([key, value]) => `["${key}": [${convertToString(value)}]]`)   
                .join(', ');
            const newbleed_lingual = Object.entries(bleed_lingual)
                .map(([key, value]) => `["${key}": [${convertToString(value)}]]`)   
                .join(', ');
            const newbleed_buccal_bot = Object.entries(bleed_buccal_bot)
                .map(([key, value]) => `["${key}": [${convertToString(value)}]]`)   
                .join(', ');    
                
            const newplaque_buccal = Object.entries(plaque_buccal)
                .map(([key, value]) => `["${key}": [${convertToString(value)}]]`)   
                .join(', '); 
            const newplaque_palatal = Object.entries(plaque_palatal)
                .map(([key, value]) => `["${key}": [${convertToString(value)}]]`)   
                .join(', ');
            const newplaque_lingual = Object.entries(plaque_lingual)
                .map(([key, value]) => `["${key}": [${convertToString(value)}]]`)   
                .join(', ');
            const newplaque_buccal_bot = Object.entries(plaque_buccal_bot)
                .map(([key, value]) => `["${key}": [${convertToString(value)}]]`)   
                .join(', ');
 
            const newgingivalmargin_buccal = Object.entries(gingivalmargin_buccal)
                .map(([key, value]) => `["${key}": [${convertToString(value)}]]`)   
                .join(', '); 
            const newgingivalmargin_palatal = Object.entries(gingivalmargin_palatal)
                .map(([key, value]) => `["${key}": [${convertToString(value)}]]`)   
                .join(', ');
            const newgingivalmargin_lingual = Object.entries(gingivalmargin_lingual)
                .map(([key, value]) => `["${key}": [${convertToString(value)}]]`)   
                .join(', ');
            const newgingivalmargin_buccal_bot = Object.entries(gingivalmargin_buccal_bot)
                .map(([key, value]) => `["${key}": [${convertToString(value)}]]`)   
                .join(', ');
                    
            const newprobingdepth = Object.entries(probingdepth)
                .map(([key, value]) => `["${key}": [${convertToString(value)}]]`)   
                .join(', ');
            const newprobingdepth_buccal = Object.entries(probingdepth_buccal)
                .map(([key, value]) => `["${key}": [${convertToString(value)}]]`)   
                .join(', '); 
            const newprobingdepth_palatal = Object.entries(probingdepth_palatal)
                .map(([key, value]) => `["${key}": [${convertToString(value)}]]`)   
                .join(', ');
            const newprobingdepth_lingual = Object.entries(probingdepth_lingual)
                .map(([key, value]) => `["${key}": [${convertToString(value)}]]`)   
                .join(', ');
            const newprobingdepth_buccal_bot = Object.entries(probingdepth_buccal_bot)
                .map(([key, value]) => `["${key}": [${convertToString(value)}]]`)   
                .join(', ');

            clientcode      = $('#clientcode').val();  
            // console.log(newfurcations);
            $.ajax({
                type: "POST",
                url:"<?php echo base_url('Procedures/submit_periodontalchart');?>",
                data: {
                    clientcode:clientcode,
                    teeth:teeth,
                    mobility:mobility,
                    implants:implants,

                    furcations:newfurcations,

                    bleed_buccal:newbleed_buccal,
                    bleed_palatal:newbleed_palatal,
                    bleed_lingual:newbleed_lingual,
                    bleed_buccal_bot:newbleed_buccal_bot,

                    plaque_buccal:newplaque_buccal,
                    plaque_palatal:newplaque_palatal,
                    plaque_lingual:newplaque_lingual,
                    plaque_buccal_bot:newplaque_buccal_bot,
 
                    gingivalmargin_buccal:newgingivalmargin_buccal,
                    gingivalmargin_palatal:newgingivalmargin_palatal,
                    gingivalmargin_lingual:newgingivalmargin_lingual,
                    gingivalmargin_buccal_bot:newgingivalmargin_buccal_bot,
 
                    probingdepth_buccal:newprobingdepth_buccal,
                    probingdepth_palatal:newprobingdepth_palatal,
                    probingdepth_lingual:newprobingdepth_lingual,
                    probingdepth_buccal_bot:newprobingdepth_buccal_bot,
                },
                success:function(data){ 
                    alert('Successfilly Submitted');  
                }
            });
        }); 

        $('.remarks_btn').on('click',function(){
            var i_tooth_no = $(this).data('no');
            var i_type = $(this).data('type'); 
            
            var currentdate = $('.currentdate').val();
            var clientcode = $('#clientcode').val();
            $('#i_tooth_no').val(i_tooth_no); 
            $('#i_type').val(i_type); 
            $('.tooth_no_label').html(i_tooth_no);  
            $('.type_label').html(i_type); 

            $.ajax({
                type: "POST",
                url:"<?php echo base_url('Procedures/retrieve_remarks');?>",
                data: 
                {
                    i_tooth_no:i_tooth_no, 
                    i_type:i_type, 
                    clientcode:clientcode,
                    currentdate:currentdate
                },
                success:function(data){ 
                    data = JSON.parse(data);  
                    $('#i_remarks').val('');
                    if(data.length!=0){
                        $('#i_remarks').val(data[0].CPRL_Remarks);
                    }
                    
                }
            });
        });

        $('#submit_remarks').submit(function(e){
            e.preventDefault();

            var i_tooth_no = $('#i_tooth_no').val();
            var i_type = $('#i_type').val(); 
            var i_remarks = $('#i_remarks').val();
            var clientcode = $('#clientcode').val();
            var currentdate = $('.currentdate').val();
            $.ajax({
                type: "POST",
                url:"<?php echo base_url('Procedures/submit_remarks');?>",
                data: 
                {
                    i_tooth_no:i_tooth_no, 
                    i_type:i_type,
                    i_remarks:i_remarks,
                    clientcode:clientcode,
                    currentdate:currentdate
                },
                success:function(data){ 
                    alert('Successfully Submitted');
                    $("#remarks_modal").modal('hide');
                }
            });


        });

        $('#generate_treatmentnotes').submit(function(e){
            e.preventDefault();
            
            from        = $('#tn_date_from').val();
            to          = $('#tn_date_to').val();
            clientcode  = $('#clientcode').val();
            $.ajax({
                type: "POST",
                url:"<?php echo base_url('Procedures/generate_treatmentnotes');?>",
                data: 
                {
                    from:from,
                    to:to,
                    clientcode:clientcode 
                },
                success:function(data){
                    // window.location.href = '<?= site_url('Procedures/Treatment_Notes_pdf') ?>';   
                    window.open('<?= base_url('Procedures/Treatment_Notes_pdf') ?>', '_blank');   
                }
            });
        });
    });
        
    function getclientinfo(){
        acc_refno = $('#acc_refno').val();
        $.ajax({
            type: "POST",
            url:"<?php echo base_url('Procedures/getclientinfobyrefno');?>",
            data: 
            {
                acc_refno:acc_refno, 
            },
            success:function(data){ 
                data = JSON.parse(data); 
                $('#client_name').empty();    
                $('#client_name').html(data[0].Fullname);  
                $('#clientcode').val(data[0].CLI_Code);  
                
                retrieveperiodontaldata();
            }
        });
    }

    function retrieveperiodontaldata(){
        clientcode = $('#clientcode').val();
        $.ajax({
            type: "POST",
            url:"<?php echo base_url('Procedures/retrieveperiodontaldata');?>",
            data: 
            {
                clientcode:clientcode, 
            },
            success:function(data){ 
                data = JSON.parse(data);
                if(data.length!=0){
                    for(index in data){ 
                        CPL_Date = data[index].CPL_Date;
                        $('#CPL_Date').html(CPL_Date);

                        
                        teeth = JSON.parse(data[index].CPL_Teeth); 
                        implants = JSON.parse(data[index].CPL_Implants); 
                        mobility = JSON.parse(data[index].CPL_Mobility); 
                        furcations = cleanjson(data[index].CPL_Furcations);
                        
                        populate_teeth(teeth);
                        populate_mobility(mobility);
                        populate_implants(implants);  
                        populate_furcations(furcations);

                        bleed_buccal = cleanjson(data[index].CPL_Bleed_Buccal);
                        bleed_palatal = cleanjson(data[index].CPL_Bleed_Palatal);
                        bleed_lingual = cleanjson(data[index].CPL_Bleed_Lingual);
                        bleed_buccal_bot = cleanjson(data[index].CPL_Bleed_Buccal_Bot);
                         
                        populate_bleed(bleed_buccal,'buccal');
                        populate_bleed(bleed_palatal,'palatal');
                        populate_bleed(bleed_lingual,'lingual');
                        populate_bleed(bleed_buccal_bot,'buccal-bot');

                        plaque_buccal = cleanjson(data[index].CPL_Plaque_Buccal);
                        plaque_palatal = cleanjson(data[index].CPL_Plaque_Palatal);
                        plaque_lingual = cleanjson(data[index].CPL_Plaque_Lingual);
                        plaque_buccal_bot = cleanjson(data[index].CPL_Plaque_Buccal_Bot);
                         
                        populate_plaque(plaque_buccal,'buccal');
                        populate_plaque(plaque_palatal,'palatal');
                        populate_plaque(plaque_lingual,'lingual');
                        populate_plaque(plaque_buccal_bot,'buccal-bot');
 
                        gingivalmargin_buccal = cleanjson(data[index].CPL_Gingival_Margin_Buccal);
                        gingivalmargin_palatal = cleanjson(data[index].CPL_Gingival_Margin_Palatal);
                        gingivalmargin_lingual = cleanjson(data[index].CPL_Gingival_Margin_Lingual);
                        gingivalmargin_buccal_bot = cleanjson(data[index].CPL_Gingival_Margin_Buccal_Bot);
                         
                        populate_gingivalmargin(gingivalmargin_buccal,'buccal');
                        populate_gingivalmargin(gingivalmargin_palatal,'palatal');
                        populate_gingivalmargin(gingivalmargin_lingual,'lingual');
                        populate_gingivalmargin(gingivalmargin_buccal_bot,'buccal-bot');
                        
                        probingdepth_buccal = cleanjson(data[index].CPL_Probing_Depth_Buccal);
                        probingdepth_palatal = cleanjson(data[index].CPL_Probing_Depth_Palatal);
                        probingdepth_lingual = cleanjson(data[index].CPL_Probing_Depth_Lingual);
                        probingdepth_buccal_bot = cleanjson(data[index].CPL_Probing_Depth_Buccal_Bot);
                         
                        populate_probingdepth(probingdepth_buccal,'buccal');
                        populate_probingdepth(probingdepth_palatal,'palatal');
                        populate_probingdepth(probingdepth_lingual,'lingual');
                        populate_probingdepth(probingdepth_buccal_bot,'buccal-bot');
                    }
                }
                
            }
        });
    }
    function cleanjson(val){
        let vall = val.replace(/\\/g, '');
        vall = vall.slice(1, -1);  
        
        vall = vall
            .replace(/\["([^"]+)"\s*:\s*\["([^"]+)"\s*:\s*"([^"]+)"\]\]/g, `"$1": { "$2": "$3" }`)
            .replace(/\],/g, '},')   
            .replace(/\]$/, '}');    

        vall = `{${vall}}`;

        vall = JSON.parse(vall);
        return vall;
    }
    function populate_teeth(teeth){
        for(i=0;i<=teeth.length;i++){
            if(teeth[i]!=''){
                button = $('.maintoothlabel[data-no="'+i+'"]');
                button.attr('data-value',teeth[i]);

                const content = $('.cellno-'+i+'');
                if (teeth[i] === '0') {
                    content.css('visibility', 'visible');  
                } else {
                    content.css('visibility', 'hidden');  
                }
            }
        }
    }
    function populate_mobility(mobility){ 
        for(i=0;i<=mobility.length;i++){
            if(mobility[i]!=''){
                button = $('.mobility[data-no="'+i+'"]');
                button.attr('value',mobility[i]);
            }
        }
    }
    function populate_implants(implants){  
        for(i=0;i<=16;i++){     
            if(implants[i]!=''){
                topsrc = $('img.buccal-top[data-no="' + i + '"]').attr('src');
                botsrc = $('img.palatal-bot[data-no="' + i + '"]').attr('src');
                if (implants[i] === '0') {  
                    topsrc = topsrc.replace('-implant', ''); 
                    $('img.buccal-top[data-no="' + i + '"]').attr('src', topsrc);

                    botsrc = botsrc.replace('-implant', ''); 
                    $('img.palatal-bot[data-no="' + i + '"]').attr('src', botsrc);
 
                    button = $('.implant[data-no="'+i+'"]'); 
                    $('.implant[data-no="'+i+'"]').addClass('btn-light');
                    $('.implant[data-no="'+i+'"]').removeClass('btn-dark');

                } else {  
                    topsrc = topsrc.replace('.png', ''); 
                    $('img.buccal-top[data-no="' + i + '"]').attr('src', topsrc+'-implant.png');
    
                    botsrc = botsrc.replace('.png', ''); 
                    $('img.palatal-bot[data-no="' + i + '"]').attr('src', botsrc+'-implant.png');
 
                    button = $('.implant[data-no="'+i+'"]');
                    $('.implant[data-no="'+i+'"]').addClass('btn-dark');
                    $('.implant[data-no="'+i+'"]').removeClass('btn-light');
                }
                
                // button = $('.implant[data-no="'+i+'"]');
                button.val(implants[i]);
            }
            


        }

        for(i=31;i<=48;i++){     
            if(implants[i]!=''){
                topsrc = $('img.lingual-top[data-no="' + i + '"]').attr('src');
                botsrc = $('img.buccal-bot[data-no="' + i + '"]').attr('src');  
                if (implants[i] === '0') {  
                    topsrc = topsrc.replace('-implant', ''); 
                    $('img.lingual-top[data-no="' + i + '"]').attr('src', topsrc);

                    botsrc = botsrc.replace('-implant', ''); 
                    $('img.buccal-bot[data-no="' + i + '"]').attr('src', botsrc);
 
                    button = $('.implant-bot[data-no="'+i+'"]');
                    button.attr('value',implants[i]);
                    $('.implant-bot[data-no="'+i+'"]').addClass('btn-light');
                    $('.implant-bot[data-no="'+i+'"]').removeClass('btn-dark');
                } else {  
                    
                    topsrc = topsrc.replace('.png', ''); 
                    $('img.lingual-top[data-no="' + i + '"]').attr('src', topsrc+'-implant.png');
    
                    botsrc = botsrc.replace('.png', ''); 
                    $('img.buccal-bot[data-no="' + i + '"]').attr('src', botsrc+'-implant.png');
 
                    button = $('.implant-bot[data-no="'+i+'"]');
                    button.attr('value',implants[i]);
                    $('.implant-bot[data-no="'+i+'"]').addClass('btn-dark');
                    $('.implant-bot[data-no="'+i+'"]').removeClass('btn-light');
                    
                }
                
                // button = $('.implant[data-no="'+i+'"]');
                button.val(implants[i]);
            }
            


        }
    }
    function populate_furcations(furcations){
        for (let key in furcations) {
            if (furcations.hasOwnProperty(key)) { 
                let value = furcations[key];
                 
                // console.log(`Key: ${key}, Value: ${vall}`);
                vall = JSON.stringify(value[0]);
                vall = vall.replace(/"/g, '');  // Removes all double quotes
 
                button = $('.furcation[data-no="'+key+'"]'); 
                type = $('.furcation[data-no="'+key+'"]').attr('data-type'); 
                button.attr('value',vall);
                if(vall == 0){
                    button.html(`
                        <svg class="circle-svg" xmlns="http://www.w3.org/2000/svg">
                            <!-- Blank SVG with no content -->
                        </svg>
                    `);
                    
                    $('.'+type+'-'+key).empty();
                }else if(vall == 1){
                    button.html(`
                        <svg class="circle-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 20">
                            <circle cx="20" cy="10" r="15" stroke="black" stroke-width="1" fill="none"></circle>
                        </svg>
                    `);

                    $('.'+type+'-'+key).html(`<i class="bi bi-circle"></i>`);
                }else if(vall == 2){
                    button.html(`
                        <svg class="circle-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 1 40 20">
                            <defs>
                                <linearGradient id="halfShade" x1="0%" y1="0%" x2="100%" y2="0%">
                                    <stop offset="50%" style="stop-color: black; stop-opacity: 1;"></stop>
                                    <stop offset="50%" style="stop-color: white; stop-opacity: 1;"></stop>
                                </linearGradient>
                            </defs>
                            <circle cx="20" cy="10" r="15" stroke="black" stroke-width="1" fill="url(#halfShade)"></circle>
                        </svg>
                    `);

                    $('.'+type+'-'+key).html(`<i class="bi bi-circle-half"></i>`);
                }else if(vall == 3){ 
                    button.html(`
                        <svg class="circle-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 20">
                            <circle cx="20" cy="10" r="15" stroke="black" stroke-width="1" fill="black"></circle>
                        </svg>
                    `);

                    $('.'+type+'-'+key).html(`<i class="bi bi-circle-fill"></i>`);
                } 
                
            }
        } 
    }
    function populate_bleed(val,type){
        for (let key in val) {
            if (val.hasOwnProperty(key)) { 
                let value = val[key];
                
                bleed = $('.bleed-'+type+'[data-no="'+key+'"]');
                vall = JSON.stringify(value[0]);
                vall = vall.replace(/"/g, '');  // Removes all double quotes
                bleed.attr('value',vall);
                if(vall==0){
                    bleed.addClass('btn-light');
                    bleed.removeClass('btn-danger');
                }else if(vall==1){ 
                    bleed.addClass('btn-danger');
                    bleed.removeClass('btn-light');
                }
            }
        }
    }
    function populate_plaque(val,type){
        for (let key in val) {
            if (val.hasOwnProperty(key)) { 
                let value = val[key];
                
                plaque = $('.plaque-'+type+'[data-no="'+key+'"]');
                vall = JSON.stringify(value[0]);
                vall = vall.replace(/"/g, '');  // Removes all double quotes
                plaque.attr('value',vall);
                if(vall==0){
                    plaque.addClass('btn-light');
                    plaque.removeClass('btn-primary');
                }else if(vall==1){ 
                    plaque.addClass('btn-primary');
                    plaque.removeClass('btn-light');
                }
            }
        }
    } 
    function populate_gingivalmargin(val,type){
        for (let key in val) {
            if (val.hasOwnProperty(key)) { 
                let value = val[key];
                
                gingivalmargin = $('.gingivalmargin-'+type+'[data-no="'+key+'"]');
                vall = JSON.stringify(value[0]);
                vall = vall.replace(/"/g, '');  // Removes all double quotes
                gingivalmargin.attr('value',vall);
                
            }
        }
    }
    function populate_probingdepth(val,type){
        for (let key in val) {
            if (val.hasOwnProperty(key)) { 
                let value = val[key];
                
                probingdepth = $('.probingdepth-'+type+'[data-no="'+key+'"]');
                vall = JSON.stringify(value[0]);
                vall = vall.replace(/"/g, '');  // Removes all double quotes
                probingdepth.attr('value',vall);
                
            }
        }
    }
    function getteeth(){
        var maintoothlabel = [];
        // var implants_bot = []; 
        $('.maintoothlabel').each(function() {
            var no = $(this).data('no');
            var value = $(this).data('value');
            maintoothlabel[no] = value;    
        }); 
        return maintoothlabel;
    }

    function getmobility(){
        var mobility = [];
        // var implants_bot = []; 
        $('.mobility').each(function() {
            var no = $(this).data('no');
            var value = $(this).val();
            mobility[no] = value;    
        }); 
        return mobility;
    }

    function getimplants(){ 
        var implants =  implants_bot = [];
        // var implants_bot = []; 
        $('.implant').each(function() {
            var no = $(this).data('no');
            var toggle = $(this).val();
            implants[no] = toggle;   
        }); 

        $('.implant-bot').each(function() {
            var no = $(this).data('no');
            var toggle = $(this).val();
            implants_bot[no] = toggle;  
        });  
        return implants;
    }

    function getfurcations(){
        var furcation = [];
        $('.furcation').each(function() {
            var no = $(this).data('no'); 
            var val = $(this).val(); 
            furcation[no] = val;
        });
        return furcation;
    }

    function getbleeding(){
        var bleed = [];
        var bleed_buccal = [];
        var bleed_palatal = [];
        var bleed_lingual = [];
        var bleed_buccal_bot = [];
        $('.bleed-buccal').each(function() {
            var no = String($(this).data('no')); 
            var val = $(this).val();
            bleed_buccal[no] = val; 
        }); 
        $('.bleed-palatal').each(function() {
            var no = $(this).data('no'); 
            var val = $(this).val(); 
            bleed_palatal[no] = val;
        });
        $('.bleed-lingual').each(function() {
            var no = $(this).data('no'); 
            var val = $(this).val(); 
            bleed_lingual[no] = val;
        });
        $('.bleed-buccal-bot').each(function() {
            var no = $(this).data('no');
            var val = $(this).val();
            bleed_buccal_bot[no] = val;
        });

        bleed['buccal'] = bleed_buccal;
        bleed['palatal'] = bleed_palatal;
        bleed['lingual'] = bleed_lingual;
        bleed['buccal_bot'] = bleed_buccal_bot;

        return bleed;
    }

    function getplaque(){
        var plaque = [];
        var plaque_buccal = [];
        var plaque_palatal = [];
        var plaque_lingual = [];
        var plaque_buccal_bot = [];
        $('.plaque-buccal').each(function() {
            var no = $(this).data('no'); 
            var val = $(this).val();
            plaque_buccal[no] = val;
            
        });
        $('.plaque-palatal').each(function() {
            var no = $(this).data('no'); 
            var val = $(this).val(); 
            plaque_palatal[no] = val;
        });
        $('.plaque-lingual').each(function() {
            var no = $(this).data('no'); 
            var val = $(this).val(); 
            plaque_lingual[no] = val;
        });
        $('.plaque-buccal-bot').each(function() {
            var no = $(this).data('no');
            var val = $(this).val();
            plaque_buccal_bot[no] = val;
        });

        plaque['buccal'] = plaque_buccal;
        plaque['palatal'] = plaque_palatal;
        plaque['lingual'] = plaque_lingual;
        plaque['buccal_bot'] = plaque_buccal_bot;

        return plaque;
    }

    function getgingivalmargin(){
        var gingivalmargin = [];
        var gingivalmargin_buccal = [];
        var gingivalmargin_palatal = [];
        var gingivalmargin_lingual = [];
        var gingivalmargin_buccal_bot = [];
        $('.gingivalmargin-buccal').each(function() {
            var no = $(this).data('no'); 
            var val = $(this).val();
            gingivalmargin_buccal[no] = val;
            
        }); 
        $('.gingivalmargin-palatal').each(function() {
            var no = $(this).data('no'); 
            var val = $(this).val(); 
            gingivalmargin_palatal[no] = val;
        });
        $('.gingivalmargin-lingual').each(function() {
            var no = $(this).data('no'); 
            var val = $(this).val(); 
            gingivalmargin_lingual[no] = val;
        });
        $('.gingivalmargin-buccal-bot').each(function() {
            var no = $(this).data('no');
            var val = $(this).val();
            gingivalmargin_buccal_bot[no] = val;
        });

        gingivalmargin['buccal'] = gingivalmargin_buccal;
        gingivalmargin['palatal'] = gingivalmargin_palatal;
        gingivalmargin['lingual'] = gingivalmargin_lingual;
        gingivalmargin['buccal_bot'] = gingivalmargin_buccal_bot;
         
        return gingivalmargin; 
    }

    function getprobingdepth(){
        var probingdepth = [];
        var probingdepth_buccal = [];
        var probingdepth_palatal = [];
        var probingdepth_lingual = [];
        var probingdepth_buccal_bot = [];
        $('.probingdepth-buccal').each(function() {
            var no = $(this).data('no'); 
            var val = $(this).val();
            probingdepth_buccal[no] = val;
            
        }); 
        $('.probingdepth-palatal').each(function() {
            var no = $(this).data('no'); 
            var val = $(this).val(); 
            probingdepth_palatal[no] = val;
        });
        $('.probingdepth-lingual').each(function() {
            var no = $(this).data('no'); 
            var val = $(this).val(); 
            probingdepth_lingual[no] = val;
        });
        $('.probingdepth-buccal-bot').each(function() {
            var no = $(this).data('no');
            var val = $(this).val();
            probingdepth_buccal_bot[no] = val;
        });

        probingdepth['buccal'] = probingdepth_buccal;
        probingdepth['palatal'] = probingdepth_palatal;
        probingdepth['lingual'] = probingdepth_lingual;
        probingdepth['buccal_bot'] = probingdepth_buccal_bot;
         
        return probingdepth; 
    }
    
</script>
