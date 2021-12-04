edit = document.getElementsByClassName('edit')
deletebtn = document.getElementsByClassName('delete')
sno = document.getElementById('sno')
delSno = document.getElementById('delsno')

// console.log(deletebtn)

Array.from(edit).forEach((element) => {
    element.addEventListener('click', (e) => {
        let link = e.target.id
        console.log(link)
        editcategoryName = document.getElementById('editcategoryName')
        editorderNumber = document.getElementById('editorderNumber')
        editCouponExpire = document.getElementById('editCouponExpire')
        let tr = e.target.parentNode.parentNode

        if (editCouponExpire) {
            let expireDate = tr.getElementsByTagName('td')[5].innerText
            editCouponExpire.value = expireDate
        }


        //console.log(tr) previousSibling;

        if (editcategoryName) {
            let title = tr.getElementsByTagName('td')[0].innerText
            editcategoryName.value = title

        }


        let orderNum = tr.getElementsByTagName('td')[1].innerText


        editorderNumber.value = orderNum
        sno.value = link

        console.log(editCouponExpire)

        console.log(title)


    });

})