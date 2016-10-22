<div class="post">
    <div class="post_title">
        <a>تکمیل و ارسال سفارش به مقصد</a>
    </div>    <table class="basket">
        <tr>
            <td>شماره پیگیری</td><td>قیمت</td><td>تاریخ</td><td>نوع پرداخت</td><td>پایان کار</td>
        </tr>
        [INCOMPLETE_ORDERS]
        <tr>
            <td>{INCOMPLETE_TRACK_ID}</td><td>{INCOMPLETE_PRICE}</td><td>{INCOMPLETE_DATE}</td><td>{INCOMPLETE_PAYMENT}</td><td><a href="index.php?admin_orders_view=1&send={INCOMPLETE_TRACK_ID}">تکمیل شد</a></td>
        </tr>
        [/INCOMPLETE_ORDERS]
    </table>
</div>