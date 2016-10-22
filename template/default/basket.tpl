<div class="post">
    <div class="post_title">
        <a>سبد خرید شما</a>
    </div>
    <div class="post_block">
        <form action="index.php?calculate=1" method="post">
            <table class="basket">
                <tr>
                    <td>شماره کالا</td><td>نام کالا</td><td>قیمت</td><td>موجودی انبار</td><td>تعداد</td><td>حذف از سبد</td>
                </tr>
                [ELEMENT]
                <tr class="basket_item">
                    <td>{ID}</td><td>{NAME}</td><td>{PRICE}</td><td>{NUMBER_EXIST}</td><td><input type="text" name="some[]" value="1"></td><td><a href="index.php?remove_to={ID}"><img src="{ADDRESS}img/del-small.png"></a></td>
                </tr>
                [/ELEMENT]
                <tr>
                    <td>نحوه پرداخت</td>
                    <td colspan="2">
                        <select name="payment_model">
                            <option value="1">پرداخت از کارت</option>
                            <option value="2">دریافت وجه از طریق پست</option>
                        </select>
                    </td>
                    <td>نحوه ارسال</td>
                    <td>
                        <select name="send_model">
                            <option value="1">پیشتاز</option>
                            <option value="2">سفارشی</option>
                        </select>
                    </td>
                    <td><input type="submit" name="submit" value="ثبت سفارش"></td>
                </tr>
            </table>
        </form>
    </div>
</div>