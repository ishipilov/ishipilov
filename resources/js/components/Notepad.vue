<template>
	<div :id="id">
    <slot name="notepad_slot" :on-show="onShow"/>
		<!-- Modal -->
		<div class="modal fade" id="notepadModal" tabindex="-1">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">
							<template v-if="waiting">
								<span class="spinner-border spinner-border-sm" role="status"></span>
								<span>Wait...</span>
							</template>
							<template v-else><span>Notepad</span></template>
						</h5>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						<form>
							<div class="form-group">
								<textarea v-model="input" class="form-control" id="notepad-text" name="text" rows="6" :disabled="waiting"></textarea>
							</div>
							<button type="button" class="btn btn-sm" :class="selected && ! input ? 'btn-danger' : 'btn-success'" :disabled="waiting || (! input && ! selected) || input == selected.text" @click.prevent="save">
								<template v-if="selected && ! input">Delete</template>
								<template v-else>Save</template>
							</button>
							<button type="button" class="btn btn-primary btn-sm" :disabled="waiting || ! input" @click.prevent="store">Save as new</button>
							<button type="button" class="btn btn-secondary btn-sm" :disabled="waiting" @click.prevent="clear">Clear</button>
						</form>
					</div>
					<div class="list-group list-group-flush rounded">
						<template v-for="note in orderedByDesc" v-key="note.id">
							<button type="button" class="list-group-item list-group-item-action text-truncate" :class="{ active: selected && selected.id == note.id }" :disabled="waiting" @click.prevent="select(note)">{{ note.text }}</button>
						</template>
					</div>
				</div>
			</div>
		</div>
  </div>
</template>

<script>

export default {
  name: 'vue-notepad',
  props: {
		url: { type: String, default: "" }
  },
  data: function () {
		return {
			id: null,
			notepad: [],
			selected: null,
			input: "",
			waiting: false,
			error: null
		}
  },
	computed: {
		orderedByDesc: function () {
			return _.orderBy(this.notepad, ['id'], ['desc'])
		}
	},
  created: function () { this.id = this.$options.name + this._uid },
  mounted: function () {  },
  methods: {
		onShow: function () {
			if (_.isEmpty(this.notepad)) this.load()
			$('#notepadModal').modal('show')
		},
		clear: function () {
			this.input = ""
		},
		select: function (note) {
			if (this.selected && this.selected.id == note.id) {
				this.selected = null
			} else {
				this.selected = note
				this.input = note.text
			}
		},
		save: function () {
			if (this.selected) {
				this.update()
				if (! this.input) this.selected = null
			} else {
				this.store()
			}
		},
		update: function () {
			this.waiting = true
			let url = `${this.url}/${this.selected.id}`
			let requestData = {
				headers: { 'Accept': 'application/json' },
				method: 'patch',
				url: url,
				data: {
					text: this.input
				}
			}
			axios(requestData)
			.then((response) => {
				this.waiting = false
				this.load()
			}).catch((error) => {
				this.error = error.response
				this.waiting = false
			})
		},
		store: function () {
			this.waiting = true
			let requestData = {
				headers: { 'Accept': 'application/json' },
				method: 'post',
				url: this.url,
				data: {
					text: this.input
				}
			}
			axios(requestData)
			.then((response) => {
				this.waiting = false
				if (response.status == 201) this.selected = response.data
				this.load()
			}).catch((error) => {
				this.error = error.response
				this.waiting = false
			})
		},
		load: function () {
			this.waiting = true
			let requestData = {
				headers: { 'Accept': 'application/json' },
				method: 'get',
				url: this.url
			}
			axios(requestData)
			.then((response) => {
				this.notepad = response.data.notepad
				this.waiting = false
			}).catch((error) => {
				this.error = error.response
				this.waiting = false
			})
		}
  }
};
</script>
