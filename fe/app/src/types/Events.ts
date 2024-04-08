import { CategoryAPI } from "./Category";

export type EventAPI = {
  id: number
  name: string
  description: string
  attendees: string;
  date_time: Date;
  address: string;
  country: string;
  city: string;
  country_code: string;
  lon: number;
  lat: number;
  timezone_name: string;
  categories: CategoryAPI[];
}

export type Event = {
  id: number
  name: string
  description: string
  attendees: string;
  date_time: Date;
  address: string;
  country: string;
  city: string;
  country_code: string;
  lon: number;
  lat: number;
  timezone_name: string;
  categories: string[];
}
