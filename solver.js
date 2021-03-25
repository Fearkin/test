import {json} from "./constants.js";

class Solver {

    constructor(product) {
        this.product = product;
        this.stocks = this.product.stock.stocks["34"];
        this.pairs = Object.entries(this.stocks);
    }

    getProductName() {
        console.log("Название товара:")
        console.log(this.product.displayedName.displayedName.value[0]);
    }

    getShops() {
        console.log("Массив номеров магазинов, в которых товар есть в наличии:")
        console.log(this.pairs
            .filter((pair) => parseInt(pair[1]) > 0)
            .map((pair) => pair[0]));
    }

    getMaxAmount() {
        let max = 0;
        let amountOfProduct = 0;
        let shop = "";
        for (const [currentShop, amount] of this.pairs){
            amountOfProduct = parseInt(amount);
            if (amountOfProduct > max){
                max = amountOfProduct;
                shop = currentShop;
            }
        }
        console.log(`Максимальное количество товара в регионе - ${max}, в магазине под номером ${shop}`)
    }
}

const solver = new Solver(json);
solver.getProductName();
solver.getShops();
solver.getMaxAmount();