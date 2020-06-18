<template>
    <v-navigation-drawer
            v-model="drawer"
            app
            clipped
            color="grey lighten-4"
    >
        <v-list
                dense
                class="grey lighten-4"
        >
            <v-list-item @click="redirectHome">
                <v-list-item-action>
                    <v-icon>home</v-icon>
                </v-list-item-action>
                <v-list-item-content>
                    <v-list-item-title class="grey--text">
                        Home
                    </v-list-item-title>
                </v-list-item-content>
            </v-list-item>
            <v-list-item>
                <v-list-item-action>
                    <v-icon>lightbulb_outline</v-icon>
                </v-list-item-action>
                <v-list-item-content>
                    <v-list-item-title class="grey--text">
                        Account
                    </v-list-item-title>
                </v-list-item-content>
            </v-list-item>
            <v-list-item>
                <v-list-item-action>
                    <v-icon>touch_app</v-icon>
                </v-list-item-action>
                <v-list-item-content @click="showTotal">
                    <v-list-item-title class="grey--text">
                        Wish List
                    </v-list-item-title>
                </v-list-item-content>
            </v-list-item>
            <v-divider inset></v-divider>
            <v-list-item @click="redirectCart">
                <v-list-item-action>
                    <v-icon>archive</v-icon>
                </v-list-item-action>
                <v-list-item-content>
                    <v-list-item-title class="grey--text">
                        Cart ({{ cart.grand_total | price }})
                    </v-list-item-title>
                </v-list-item-content>
            </v-list-item>
            <v-list-item @click="clearCart">
                <v-list-item-action>
                    <v-icon>delete</v-icon>
                </v-list-item-action>
                <v-list-item-content>
                    <v-list-item-title class="grey--text">
                        Empty Cart
                    </v-list-item-title>
                </v-list-item-content>
            </v-list-item>
        </v-list>
    </v-navigation-drawer>
</template>

<script>
    import { mapState, mapActions, mapGetters } from 'vuex'
    export default {
        name: "Navigation",
        props: {
            source: String,
        },
        data: () => ({
            drawer: null,
        }),
        methods: {
            ...mapActions('cart', [
                'clearCart',
                'get'
            ]),
            showTotal() {
                console.log(this.$store.getters['cart/getCart']);
            },
            redirectCart() {
                this.$router.push('cart');
            },
            redirectHome() {
                this.$router.push({path: '/'});
            },
        },
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
        },
        mounted() {
            this.get();
        }
    }
</script>

<style scoped>

</style>
