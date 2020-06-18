<template>
    <v-card
            class="mx-auto"
            width="70%"
            rounded="true"
    >
        <v-row class="mb-6" align="top">
            <v-col
                    cols="12"
                    md="12"
                    class="pa-md-6"
            >
                <v-simple-table>
                    <template v-slot:default>
                        <thead>
                        <tr>
                            <th class="text-left">Name</th>
                            <th class="text-right">Price</th>
                            <th class="text-right">Quantity</th>
                            <th class="text-right">Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        <template v-for="category in cart.items">
                            <tr v-for="item in category.books" :key="item.id">
                                <td>{{ item.name }}</td>
                                <td class="text-right">{{ item.price  | price}}</td>
                                <td class="text-right">{{ item.qty }}</td>
                                <td class="text-right">{{ item.qty*item.price  | price}}</td>
                            </tr>
                            <tr class="font-weight-medium">
                                <td colspan="3">Sub Total</td>
                                <td colspan="3" class="text-right">{{category.sub_total | price}}</td>
                            </tr>
                            <tr v-if="category.discount" class="font-weight-medium">
                                <td colspan="3">Discount</td>
                                <td colspan="3" class="text-right">{{category.discount || 0}}%</td>
                            </tr>
                            <tr v-if="category.discount" class="font-weight-medium">
                                <td colspan="3">Total</td>
                                <td colspan="3" class="text-right">{{category.total | price}}</td>
                            </tr>
                        </template>
                        <tr class="font-weight-bold">
                            <td colspan="3" >Grand Total</td>
                            <td colspan="3" class="text-right">{{cart.grand_total | price}}</td>
                        </tr>
                        </tbody>
                    </template>
                </v-simple-table>
                <v-row class="d-flex">
                    <v-col class="justify-end">
                        <v-btn color="primary">Checkout</v-btn>
                    </v-col>
                </v-row>
            </v-col>
        </v-row>

    </v-card>
</template>

<script>
    import { mapState, mapActions, mapGetters } from 'vuex'
    export default {
        name: "Cart",
        computed: {
            ...mapGetters('cart', {
                cart: 'getCart'
            })
        },
        filters: {
            price: function (value) {
                if(value)
                    return '$'+value.toFixed(2);
                return 0;
            }
        }
    }
</script>

<style scoped>

</style>
