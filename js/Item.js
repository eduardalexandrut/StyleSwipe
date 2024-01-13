//Item class.
class Item {
    constructor(name, brand, link, price, size, x, y) {
        this.name = name;
        this.brand = brand;
        this.link = link;
        this.price = price;
        this.size = size;
        this.x = x;
        this.y = y;
    }

    // Getters
    getName() {
        return this.name;
    }

    getBrand() {
        return this.brand;
    }

    getLink() {
        return this.link;
    }

    getPrice() {
        return this.price;
    }

    getSize() {
        return this.size;
    }

    getX() {
        return this.x;
    }

    getY() {
        return this.y;
    }
}

export default Item;