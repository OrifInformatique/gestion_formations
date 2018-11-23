<?php $readonly = TRUE; //This should be imported from the model
$readonly_text = " onclick='return false' onkeydown='return false'"; ?>
<div class="container">
    <table class="row" style="border: 1px purple solid">
        <tr>
            <td><b>Nom</b></td>
            <td>nom</td>
        </tr>
        <tr>
            <td><b>Prénom</b></td>
            <td>prenom</td>
        </tr>
        <tr>
            <td><b>Formation</b></td>
            <td>formation</td>
        </tr>
        <tr>
            <td><b>Année</b></td>
            <td>annee</td>
        </tr>
        <tr>
            <td><b>MSP référent</b></td>
            <td>msp</td>
        </tr>
    </table>
    <table class="row" style="border: 1px orange solid">
        <tr>
            <th>Modules</th>
            <th>Notes</th>
        </tr>
        <tr>
            <td>module</td>
            <td>0.5</td>
        </tr>
    </table>
    <div>
        <div class="row" style="border: 1px yellow solid; text-align: center">
            <span class="col-lg-2">A</span>
            <span class="col-lg-2">B</span>
            <span class="col-lg-2">C</span>
            <span class="col-lg-2">D</span>
            <span class="col-lg-2">E</span>
        </div>
        <div class="row" style="border: 1px green solid">
            <table>
                <tr>
                    <td></td>
                    <td class="rotate90">Taxonomie</td>
                    <td class="rotate90">Expliqué</td>
                    <td class="rotate90">Exercé</td>
                    <td class="rotate90">Autonome</td>
                </tr>
                <!-- put this in a loop -->
                <tr style="text-align: center;">
                    <td>Description</td>
                    <td>Numéro</td>
                    <td><input type="checkbox" name="explique" <?php if($readonly) {echo $readonly_text;} ?>></td>
                    <td><input type="checkbox" name="exerce" <?php if($readonly) {echo $readonly_text;} ?>></td>
                    <td><input type="checkbox" name="autonome" <?php if($readonly) {echo $readonly_text;} ?>></td>
                </tr>
                <!-- end of loop -->
            </table>
        </div>
    </div>
</div>