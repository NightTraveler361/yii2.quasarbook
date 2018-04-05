<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="wrapper">
    <table class="workList">
        <tr>
            <th></th>
            <th>Задача</th>
        </tr>
        <tr>
            <td class="checkBox"><input type="checkbox" name="option1" value="a1"></td>
            <td>Почистить зубы</td>
        </tr>
        <tr>
            <td class="checkBox"><input type="checkbox" name="option2" value="a2"></td>
            <td>Накормить кота</td>
        </tr>
    </table>

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'work')->label(false) ?>

        <div class="form-group addWork">
            <?= Html::submitButton('Добавить', ['class' => 'btn btn-primary']) ?>
        </div>

    <?php ActiveForm::end(); ?>
</div>

<script>
$(document).ready(function() {
    $('form').on('beforeSubmit', function(){
        var data = $(this).serialize();
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: data,
            success: function(res){
                if ($('.workList td.checkBox input').length == 0) {
                    $('.workList').show();
                }
                $('.workList').append(res);
                $('#form-work').val('');
                console.log(res);
            },
            error: function(){
                alert('Error!');
            }
        });
        return false;
    });
    
    $(document).on('click', '.workList td.checkBox input', function() {
        $(this).closest('tr').remove();
        if ($('.workList td.checkBox input').length == 0) {
            $('.workList').hide();
        }
    });
});
</script>