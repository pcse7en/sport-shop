<div class="post">
    <div class="post_title">
        <a>صورت حساب</a>
    </div>
    <div class="post_block">
        <form method="post" action="index.php?{PAGE}=1&track={INVOICE_ID}">
            <table class="invoice">
                <tr>
                    <td colspan="4">صورت حساب خرید مشتری</td>
                </tr>
                <tr>
                    <td>نام</td><td>شماره موبایل</td><td colspan="2">ایمیل</td>
                </tr>
                <tr>
                    <td>{USERNAME}</td><td>{MOBILE}</td><td colspan="2">{EMAIL}</td>
                </tr>
                <tr style="border-bottom: 1px solid black;">
                    <td colspan="4">آدرس : {POST_ADDRESS}</td>
                </tr>
                <tr>
                    <td>شماره کالا</td><td>نام کالا</td><td>تعداد</td><td>قیمت کل</td>
                </tr>
                [PRODUCT]
                <tr>
                    <td>{ID}</td><td>{NAME}</td><td>{SOME}</td><td>{PRICE}</td>
                </tr>
                [/PRODUCT]
                <tr>
                    <td>هزینه ارسال</td><td>{POST_COST}</td><td>مالیات بر ارزش افزوده</td><td>{TAX}</td>
                </tr>
                <tr>
                    <td colspan="2" bgcolor="#87cefa">شماره ثبت : {INVOICE_ID}</td>
                    <td>مبلغ کل سفارش</td><td>{TOTAL_PRICE}</td>
                </tr>
                <tr>
                    <td>{WEIGHT} گرم</td><td>{SEND_MODEL}</td>
                    [BANK]
                    <td>اتصال به بانک</td><td><input type="submit" name="payment" value="پرداخت"></td>
                    [/BANK]
                    [POST]
                    <td>قبول و ارسال</td><td><input type="submit" name="send" value="درب منزل"></td>
                    [/POST]
                </tr>
            </table>
        </form>
    </div>
</div>
