<template>
    <div>
        <el-form ref="form" :model="form" label-width="120px">
            <el-form-item label="Name">
                <el-input v-model="form.name" placeholder="Enter part of name or leave blank for any"></el-input>
            </el-form-item>
            <el-form-item label="Price">
                <el-col :span="11">
                    <el-input v-model="form.price_min" placeholder="Min. price or blank for any"></el-input>
                </el-col>
                <el-col class="line" :span="2">-</el-col>
                <el-col :span="11">
                    <el-input v-model="form.price_max" placeholder="Max. price or blank for any"></el-input>
                </el-col>
            </el-form-item>
            <el-form-item>
                <el-button type="primary" @click="onSearch">Find</el-button>
            </el-form-item>
        </el-form>
        <el-table :data="found" empty-text="Nothing found">
            <el-table-column prop="name" label="Name"></el-table-column>
            <el-table-column prop="price" label="Price">
                <template slot-scope="scope">
                    {{ formatPrice(scope.row.price) }}
                </template>
            </el-table-column>
            <el-table-column prop="bedrooms" label="Bedrooms"></el-table-column>
            <el-table-column prop="bathrooms" label="Bathrooms"></el-table-column>
            <el-table-column prop="storeys" label="Storeys"></el-table-column>
            <el-table-column prop="garages" label="Garages"></el-table-column>
        </el-table>
    </div>
</template>
<script>
import axios from 'axios';

const numeral = require('numeral');

export default {
    data() {
        return {
            form:  {
                name:      '',
                price_min: '',
                price_max: ''
            },
            found: []
        }
    },
    methods: {
        formatPrice(price) {
            return numeral(price).format('$0,0.00')
        },
        onSearch() {
            axios.post('/dynamic/search', {
                name:      this.form.name,
                price_min: this.form.price_min,
                price_max: this.form.price_max
            }).then(response => {
                console.log(response.status)
                console.log(response.data)
                this.found = response.data
                console.log(numeral(100).format('$0,0.00'))
            });
        }
    }
}
</script>
