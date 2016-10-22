<div class="post">
    <div class="post_title">
        <a>افزودن محصولی جدید</a>
    </div>
    <div class="post_block">
        <form method="post" action="index.php?admin_new_post=1&add_new=1" enctype="multipart/form-data">
            <table class="admin_forms">
                <tr>
                    <td>عنوان محصول</td><td><input type="text" name="title"></td>
                </tr>
                <tr>
                    <td>دسته بندی محصول</td><td><select name="category">{CATEGORY}</select></td>
                </tr>
                <tr>
                    <td>توضیحات در مورد محصول</td><td><textarea name="description"></textarea></td>
                </tr>
                <tr>
                    <td>تصویر محصول</td><td><input type="file" name="picture"></td>
                </tr>
                <tr>
                    <td>قیمت</td><td><input type="text" name="price"></td>
                </tr>
                <tr>
                    <td>تاریخ تولید</td><td><input type="text" name="dop"></td>
                </tr>
                <tr>
                    <td>تاریخ انقضا</td><td><input type="text" name="exp"></td>
                </tr>
                <tr>
                    <td>تعداد</td><td><input type="text" name="number"></td>
                </tr>
                <tr>
                    <td>وزن</td><td><input type="text" name="weight"></td>
                </tr>
                <tr>
                    <td>قیمت فروش عمده</td><td><input type="text" name="whole_sale_price"></td>
                </tr>
                <tr>
                    <td></td><td><input type="submit" value="درج این محصول"></td>
                </tr>
            </table>
        </form>
    </div>
</div>