export type CategoryAPI = {
  id: number
  name: string
  parent_id: number
}

export type Category = {
  id: number
  name: string
  parent_category: string | undefined
}
