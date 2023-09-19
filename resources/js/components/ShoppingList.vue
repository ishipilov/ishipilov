<template>
	<div :id="id">

		<div class="list-group">
			<a href="#" class="list-group-item list-group-item-action active" aria-current="true">
				The current link item
			</a>
			<a href="#" class="list-group-item list-group-item-action">A second link item</a>
			<a href="#" class="list-group-item list-group-item-action">A third link item</a>
			<a href="#" class="list-group-item list-group-item-action">A fourth link item</a>
			<a class="list-group-item list-group-item-action disabled">A disabled link item</a>
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
				this.indata = response.data.items
				this.waiting = false
			}).catch((error) => {
				this.error = error.response
				this.waiting = false
			})
		}
  }
};
</script>
