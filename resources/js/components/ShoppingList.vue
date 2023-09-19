<template>
	<div :id="id">

		<div class="list-group">
			<template v-for="item in indata" v-key="item.id">
				<a href="#" class="list-group-item list-group-item-action" :class="{ active: selected && selected == item }" @click.prevent="selected = item">{{ item.text }}</a>
			</template>
		</div>

  </div>
</template>

<script>

export default {
  name: 'vue-shopping_list',
  props: {
		url: { type: String, default: "" }
  },
  data: function () {
		return {
			id: null,
			indata: [],
			selected: null,
			waiting: false,
			error: null
		}
  },
  created: function () { this.id = this.$options.name + this._uid },
  mounted: function () {
		this.load()
	},
  methods: {
		load: function () {
			this.waiting = true
			let requestData = {
				headers: { 'Accept': 'application/json' },
				method: 'get',
				url: this.url
			}
			axios(requestData)
			.then((response) => {
				this.indata = response.data.shopping_list
				this.waiting = false
			}).catch((error) => {
				this.error = error.response
				this.waiting = false
			})
		}
  }
};
</script>
