let addcost = document.getElementById("addcost");
let myamount = document.getElementById("amount");

if (addcost) {
    if (myamount.value.lenght != 0) {
        let amount = myamount.value.toFixed(2);
        let details = document.getElementById("amountdetails");
        let type = document.getElementById("type");

        if (type.value == "1" || type.value == "2" || type.value == "3") {
            details.style.display = "block";
            let calcul = (amount - (amount * 20 / 100)).toFixed(2);
            details.innerHTML = `
                <div class="new">
                    <p class="detail">TVA : 20% </p>
                </div>

                <div class="new" id="HT">
                    <p class="detail" name="amount_ht">Montant HT : ${calcul}</p>
                </div>
                `
        } else if (type.value == "4" || type.value == "5") {
            details.style.display = "block";
            let calcul = (amount - (amount * 10 / 100)).toFixed(2);
            details.innerHTML = `
                <div class="new">
                    <p class="detail">TVA : 10% </p>
                </div>
                <div class="new" id="HT">
                    <p class="detail" name="amount_ht">Montant HT : ${calcul}</p>
                </div>
                `
        } else {
            details.style.display = "none";
        }

        myamount.addEventListener("input", function () {
            if (type.value == "1" || type.value == "2" || type.value == "3") {
                details.style.display = "block";
                let calcul = (amount - (amount * 20 / 100)).toFixed(2);
                details.innerHTML = `
                    <div class="new">
                        <p class="detail">TVA : 20% </p>
                    </div>

                    <div class="new" id="HT">
                        <p class="detail" name="amount_ht">Montant HT : ${calcul}</p>
                    </div>
                    `
            } else if (type.value == "4" || type.value == "5") {
                details.style.display = "block";
                let calcul = (amount - (amount * 10 / 100)).toFixed(2);
                details.innerHTML = `
                    <div class="new">
                        <p class="detail">TVA : 10% </p>
                    </div>
                    <div class="new" id="HT">
                        <p class="detail" name="amount_ht">Montant HT : ${calcul}</p>
                    </div>
                    `
            } else {
                details.style.display = "none";
            }
        });
    }
}


let dels = document.querySelectorAll(".delete");

dels.forEach(del => {
    del.addEventListener("click", function (e) {
        // console.log(e.target);
        let suppr = document.getElementById("suppr");
        suppr.href = "../controllers/controllers_members_space.php?action=delete&id=" + e.target.dataset.id;
        let confirm = document.getElementById("confirm");
        let body = document.getElementById("body");
        confirm.style.display = "block";
        body.style.opacity = "0.5";
    })

});


let decision = document.getElementById("decision");

if (decision.value == 3){
    
}
// let infos = document.querySelectorAll(".infos");

// infos.forEach(info => {
//     info.addEventListener("click", () => {
//         let informations = document.getElementById("informations");
//         informations.style.display = "block";
//     })
// })


