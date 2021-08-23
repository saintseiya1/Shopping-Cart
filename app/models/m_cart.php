<?php

/*
    Cart Class
    Handle all tasks related to showing or modifying the number of items in cart

    The cart keeps track of user selected items using a session variable, $_SESSION['cart']
    The session variable holds an array that contains the ids and the number selected of 
    the products in the cart

    $_SESSION['cart']['product_id'] = num of specific item in cart
*/

class Cart 
{
    function __construct() {}

    /* 
        Getters and Setters
    */

    /**
     * Return an array of all product info for items in the cart
     * 
     * @access public
     * @param
     * @return array, null
     */
    public function get()
    {
        if (isset($_SESSION['cart']))
        {
            // get all product ids of items in cart
            $ids = $this->get_ids();

            // use list of ids to get product info from database
            global $Products;
            return $Products->get($ids);
        }
        return NULL;
    }

    /**
     * Return an array of all product ids in cart
     * 
     * @access public
     * @param
     * @return array, null
     */
    public function get_ids()
    {
        if (isset($_SESSION['cart']))
        {
            return array_keys($_SESSION['cart']);
        }
        return NULL;
    }

    /**
     * Adds item to the cart
     * 
     * @access public
     * @param int, int
     * @return null
     */
    public function add($id, $num = 1) 
    {
        // setup or retrieve cart
        $cart = array();
        if (isset($_SESSION['cart']))
        {
            $cart = $_SESSION['cart'];
        }

        // check to see if item is already in cart
        if (isset($cart[$id]))
        {
            // if item is in cart
            $cart[$id] = $cart[$id] + $num;
        }
        else 
        {
            // if item is not in cart
            $cart[$id] = $num;
        }
        $_SESSION['cart'] = $cart;
    }

    /**
     * Empties all items from cart
     * 
     * @access public
     * @param
     * @return null
     */
    public function empty_cart()
    {
        unset($_SESSION['cart']);
    }

    /* 
        Create page parts
    */

    /**
     * Return a string, containing list items for each product in cart
     * 
     * @access public
     * @param
     * @return string
     */
    public function create_cart() 
    {
        // get products currently in cart
        $products = $this->get();

        $data = '';
        $total = 0;

        $data .= '<li class="header_row"><div class="col1">Product Name:</div>
            <div class="col2">Quantity:</div><div class="col3">Product Price:</div>
            <div class="col4">Totatl Price:</div></li>';

        if ($products != '')
        {
            // products to display
            $line = 1;

            foreach($products as $product)
            {
                // create new item in cart
                $data .= '<li';
                if ($line % 2 == 0)
                {
                    $data .= ' class="alt"';
                }
                $data .= '><div class="col1">' . $product['name'] . '</div>';
                $data .= '<div class="col2"><input name="product' . $product['id'] . 
                    '" value="' . $_SESSION['cart'][$product['id']] . '"></div>';
                $data .= '<div class="col3">$' . $product['price'] . '</div>';
                $data .= '<div class="col4">$' . $product['price'] * $_SESSION['cart'][$product['id']] . 
                    '</div></li>';

                $total += $product['price'] * $_SESSION['cart'][$product['id']];
                $line++;
            }

            // add subtotal row
            $data .= '<li class="subtotal_row"><div class="col1">Subtotal:</div>
                <div class="col2">$' . $total . '</div></li>';

            // add total row
            $data .= '<li class="total_row"><div class="col1">Total:</div>
                <div class="col2">$' . $total . '</div></li>';
        }
        else 
        {
            // no products to display
            $data .= '<li><strong>No items in the cart!</strong></li>';

            // add subtotal row
            $data .= '<li class="subtotal_row"><div class="col1">Subtotal:</div>
                <div class="col2">$0.00</div></li>';

            // add total row
            $data .= '<li class="total_row"><div class="col1">Total:</div>
                <div class="col2">$0.00</div></li>';
        }
        return $data;
    }






}

