<style>
    .custom-width {
        width: 200px;
    }
</style>
<div class="card mb-5 mb-xl-10">
    <div class="card-body pt-9 pb-0">
        <!--begin::Card body-->
        <div class="card-body"  id="LoanDocument">

           <div class="container">
               <div class="row justify-content-between">
                   <div class="col-5"> <!-- Change col-15 to col-12 for larger input field -->
                       <h5>Company Logo:</h5>
                       <p class="text-muted">Requirement for Company Logo Width 1010px, Height 784px</p>
                       <input type="file" class="form-control form-control-solid" id="companyLogoId" name="companyLogo" accept="image/*">


                   </div>
                   <div class="col-5"> <!-- Change col-15 to col-12 for larger input field -->
                       <h5>System Logo:</h5>
                       <p class="text-muted">Requirement for System Logo Width 500px, Height 500px</p>
                       <input type="file" class="form-control form-control-solid" id="companySystemId" name="companySystem" accept="image/*">

                   </div>
           </div>
           </div>

               <br><br>

               <div class="container">
                   <div class="row justify-content-between">
                       <div class="col-5"> <!-- Change col-15 to col-12 for larger input field -->
                           <h5>Side Menu Logo Max:</h5>
                           <p class="text-muted">Requirement for Company Logo Width 728px, Height 225px</p>
                           <input type="file" class="form-control form-control-solid" id="sideMenuMaxId" name="sideMenuMax" accept="image/*">


                       </div>
                       <div class="col-5"> <!-- Change col-15 to col-12 for larger input field -->
                           <h5>Side Menu Logo Min:</h5>
                           <p class="text-muted">Requirement for System Logo Width 400px, Height 400px</p>
                           <input type="file" class="form-control form-control-solid" id="sideMenuMinId" name="sideMenuMin" accept="image/*">

                       </div>
                   </div>
               </div>
               <br><br>

               <div class="container">
                   <div class="row justify-content-between">
                       <div class="col-5"> <!-- Change col-15 to col-12 for larger input field -->
                           <h5>Primary Color:</h5>
                           <p class="text-muted">Requirement for Company Logo Width 1010px, Height 784px</p>
                           <input type="color" class="form-control form-control-color custom-width form-control-solid"  id="primaryColorId" value="#ff6900" title="Choose a color">


                       </div>
                       <div class="col-5"> <!-- Change col-15 to col-12 for larger input field -->
                           <h5>Secondary Color:</h5>
                           <p class="text-muted">Requirement for System Logo Width 1010px, Height 784px</p>
                           <input type="color" class="form-control form-control-color custom-width form-control-solid"  id="secondaryColorId" value="#ff6900" title="Choose a color">

                       </div>
                   </div>
               </div>

        </div>

    </div>
